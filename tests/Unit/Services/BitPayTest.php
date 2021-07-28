<?php

namespace Tests\Unit\Services;

use App\Services\BitPay;
use BitPaySDKLight\Model\Currency;
use BitPaySDKLight\Model\Invoice\Invoice;
use BitPaySDKLight\Model\Rate\Rates;
use Tests\TestCase;

class BitPayTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateInvoice(): void
    {
        $bitPay = new BitPay();

        $this->assertInstanceOf(Invoice::class, $bitPay->createInvoice(
            1.99,
            Currency::USD,
            true
        ));
    }

    /**
     * @return void
     */
    public function testRetrieveInvoice(): void
    {
        $bitPay = new BitPay();

        $someValidInvoiceIdString = 'RPiqNWVu6drmJ9CAtUhh1x';

        $this->assertInstanceOf(Invoice::class, $bitPay->retrieveInvoice($someValidInvoiceIdString));
    }

    /**
     * @return void
     */
    public function testGetExchangeRates(): void
    {
        $bitPay = new BitPay();

        $this->assertInstanceOf(Rates::class, $bitPay->getExchangeRates());
    }

    /**
     * @return void
     */
    public function testGetExchangeRate(): void
    {
        $bitPay = new BitPay();

        $this->assertStringMatchesFormat('%f', $bitPay->getExchangeRate(Currency::USD));
    }
}
