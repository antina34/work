<?php
/** @noinspection PhpUnused */
/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\Order;
use App\Services\BitPay;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InvoiceStatusUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:status-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the unpaid invoice status';

    /**
     * @var Invoice
     */
    private Invoice $invoice;

    /**
     * @var BitPay
     */
    private BitPay $bitPay;

    /**
     * InvoiceStatusUpdater constructor.
     * @param Invoice $invoice
     * @param BitPay $bitPay
     */
    public function __construct(Invoice $invoice, BitPay $bitPay)
    {
        parent::__construct();

        $this->invoice = $invoice;
        $this->bitPay = $bitPay;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $invoices = $this->invoice->with('order')
            ->where('status', '<>', Invoice::STATUS_EXPIRED)
            ->where('status', '<>', Invoice::STATUS_COMPLETE)
            ->get();

        foreach ($invoices as $invoice) {
            $this->updateInvoiceStatus($invoice);
        }

        return true;
    }

    /**
     * @param $invoice
     */
    private function updateInvoiceStatus($invoice): void
    {
        $bitPayInvoice = $this->bitPay->retrieveInvoice($invoice->external_id);
        $invoice->status = $bitPayInvoice->getStatus();
        $invoice->save();

        Log::info("[InvoiceStatusUpdater:handle] Status updated for invoice ID " . $invoice->id);

        if ($bitPayInvoice->getStatus() === Invoice::STATUS_EXPIRED && $invoice->order) {
            $invoice->order->status = Order::STATUS_EXPIRED;
            $invoice->order->save();
        } elseif ((
            $bitPayInvoice->getStatus() === Invoice::STATUS_COMPLETE ||
            $bitPayInvoice->getStatus() === Invoice::STATUS_PAID ||
            $bitPayInvoice->getStatus() === Invoice::STATUS_CONFIRMED
            ) && $invoice->order) {
            $invoice->order->status = Order::STATUS_SUCCESS;
            $invoice->order->save();
        }
    }
}
