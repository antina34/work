<?php

namespace App\Services;

use App\Models\Invoice;
use BitPaySDKLight\Client;
use BitPaySDKLight\Exceptions\BitPayException;
use BitPaySDKLight\Exceptions\InvoiceCreationException;
use BitPaySDKLight\Model\Invoice\Invoice as BitPayInvoice;
use BitPaySDKLight\Model\Rate\Rate;
use BitPaySDKLight\Model\Rate\Rates;
use Illuminate\Support\Facades\Log;

class BitPay
{
    /**
     * @var Client
     */
    private Client $bitPay;

    /**
     * BitPay constructor.
     */
    public function __construct()
    {
        try {
            $this->bitPay = new Client(
                config('bit-pay.client_token'),
                config('bit-pay.client_env')
            );
        } catch (BitPayException $e) {
            Log::error('[BitPay:construct] Error with client connection - '.$e);
        }
    }

    /**
     * @param float $price
     * @param string $currency
     *
     * @param bool $is_test
     * @return BitPayInvoice|bool
     */
    public function createInvoice(float $price, string $currency, bool $is_test = false)
    {
        $invoice = null;
        try {
            $invoice = $this->bitPay->createInvoice(new BitPayInvoice($price, $currency));
            $this->saveInvoice($invoice, $is_test);
        } catch (InvoiceCreationException $e) {
            Log::error('[BitPay:createInvoice] Error with creating invoice - '.$e);

            return false;
        }

        return $invoice;
    }

    /**
     * @param $bitPayInvoice
     * @param $is_test
     */
    private function saveInvoice($bitPayInvoice, $is_test)
    {
        $invoice = $this->mapInvoiceFields($bitPayInvoice, $is_test);

        $invoice->save();
        Log::info('[BitPay:saveInvoice] Invoice with external ID'.$invoice->external_id.' has been saved');
    }

    /**
     * @param $bitPayInvoice
     * @param $is_test
     *
     * @return Invoice
     */
    private function mapInvoiceFields($bitPayInvoice, $is_test)
    {
        $invoice = new Invoice();

        $invoice->external_id = $bitPayInvoice->getId();
        $invoice->currency = $bitPayInvoice->getCurrency();
        $invoice->price = $bitPayInvoice->getPrice();
        $invoice->is_test = $is_test;
        $invoice->status = $bitPayInvoice->getStatus();
        $invoice->invoice_time = $bitPayInvoice->getInvoiceTime();
        $invoice->expiration_time = $bitPayInvoice->getExpirationTime();
        $invoice->current_time_string = $bitPayInvoice->getCurrentTime();
        $invoice->buyer_provided_email = $bitPayInvoice->getBuyerProvidedEmail();
        $invoice->transaction_currency = $bitPayInvoice->getTransactionCurrency();
        $invoice->amount_paid = $bitPayInvoice->getAmountPaid();

        return $invoice;
    }

    /**
     * @param $id
     *
     * @return BitPayInvoice|bool
     */
    public function retrieveInvoice($id)
    {
        try {
            $bitPayInvoice = $this->bitPay->getInvoice($id);
            $this->updateOrCreateInvoice($bitPayInvoice, true);

            return $bitPayInvoice;
        } catch (BitPayException $e) {
            Log::error('[BitPay:createInvoice] Error with retrieving invoice id:'.$id.' - '.$e);

            return false;
        }
    }

    /**
     * @param $bitPayInvoice
     * @param $is_test
     */
    private function updateOrCreateInvoice($bitPayInvoice, $is_test)
    {
        $array = $this->mapInvoiceFieldsToAnArray($bitPayInvoice, $is_test);

        $invoice = Invoice::updateOrCreate(
            ['external_id' => $bitPayInvoice->getId(), 'is_test' => $is_test],
            $array
        );
        Log::info('[BitPay:saveInvoice] Invoice with external ID'.$invoice->external_id.' has been updated');
    }

    /**
     * @param $bitPayInvoice
     * @param $is_test
     *
     * @return array
     */
    private function mapInvoiceFieldsToAnArray($bitPayInvoice, $is_test)
    {
        return [
            'currency' => $bitPayInvoice->getCurrency(),
            'price' => $bitPayInvoice->getPrice(),
            'is_test' => $is_test,
            'status' => $bitPayInvoice->getStatus(),
            'invoice_time' => $bitPayInvoice->getInvoiceTime(),
            'expiration_time' => $bitPayInvoice->getExpirationTime(),
            'current_time_string' => $bitPayInvoice->getCurrentTime(),
            'buyer_provided_email' => $bitPayInvoice->getBuyerProvidedEmail(),
            'transaction_currency' => $bitPayInvoice->getTransactionCurrency(),
            'amount_paid' => $bitPayInvoice->getAmountPaid()
        ];
    }

    /**
     * @return Rates|bool
     */
    public function getExchangeRates()
    {
        try {
            return $this->bitPay->getRates();
        } catch (BitPayException $e) {
            Log::error('[BitPay:getExchangeRates] Error with getting exchange rates - '.$e);

            return false;
        }
    }

    /**
     * @param $currency
     *
     * @return bool|Rate
     */
    public function getExchangeRate($currency): ?bool
    {
        try {
            return $this->bitPay->getRates()->getRate($currency);
        } catch (BitPayException $e) {
            Log::error('[BitPay:getExchangeRate] Error with getting exchange rate for '.$currency.'  - '.$e);

            return false;
        }
    }
}
