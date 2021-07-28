<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\SubscriptionPlan;
use App\Services\BitPay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CartController extends Controller
{
    /**
     * @var BitPay
     */
    private BitPay $bitPay;

    /**
     * @var Invoice
     */
    private Invoice $invoiceModel;

    /**
     * @var Order
     */
    private Order $orderModel;

    /**
     * CartController constructor.
     * @param BitPay $bitPay
     * @param Invoice $invoice
     * @param Order $order
     */
    public function __construct(BitPay $bitPay, Invoice $invoice, Order $order)
    {
        $this->bitPay = $bitPay;
        $this->invoiceModel = $invoice;
        $this->orderModel = $order;
    }

    /**
     * @param int $subscriptionId
     *
     * @return RedirectResponse
     * @noinspection PhpUnused
     */
    public function checkout(int $subscriptionId): RedirectResponse
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $userId = Auth::user()->id;
        $orders = Order::ofUser($userId)->where('active_until', '>', now())->get();

        $subscription = SubscriptionPlan::find($subscriptionId);

        if ($orders->isEmpty()) {
            // temporary stub to insert orders
            $bitPayInvoice = $this->bitPay->createInvoice(
                $subscription->price,
                SubscriptionPlan::SUBSCRIPTION_CURRENCY,
                config('bit-pay.client_env') === 'Test'
            );

            if ($bitPayInvoice) {
                $invoice = $this->invoiceModel->where('external_id', '=', $bitPayInvoice->getId())->first();

                if($invoice) {
                    $this->createOrderForGivenUserAndSubscription($userId, $subscription, $invoice);
                    $order = $this->orderModel->where('invoice_id', '=', $invoice->id)->first();

                    if($order) {
                        $this->updateInvoiceWithOrderId($invoice, $order);
                    }
                }

                return redirect()->to(route('invoices.show', $invoice->id ));
            }

            return redirect()->to('/my-orders');
        }

        return redirect()->to('/home');
    }

    /**
     * @param $userId
     * @param $subscription
     *
     * @param $invoice
     * @return void
     */
    private function createOrderForGivenUserAndSubscription($userId, $subscription, $invoice): void
    {
        $order = new Order();

        $order->user_id = $userId;
        $order->product_id = $subscription->product_id;
        $order->subscription_plan_id = $subscription->id;
        $order->invoice_id = $invoice->id;
        $order->price = $subscription->price;
        $order->status = Order::STATUS_PENDING;
        $order->active_until = null;
        $order->save();
    }

    /**
     * @param $invoice
     * @param $order
     */
    private function updateInvoiceWithOrderId($invoice, $order)
    {
        $invoice->order_id = $order->id;
        $invoice->save();
    }
}
