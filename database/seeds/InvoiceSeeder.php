<?php

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Invoice::updateOrCreate(
            [
                'external_id' => 'RPiqNWVu6drmJ9CAtUhh1x'
            ],
            [
                'order_id' => 1,
                'currency' => 'USD',
                'price' => 1.99,
                'is_test' => 1,
                'status' => 'migrated',
                'invoice_time' => '1593770191588',
                'expiration_time' => '1593771091588',
                'current_time_string' => '1593787591496',
                'buyer_provided_email' => 'aruna.wijewardana@lawact.ee',
                'transaction_currency' => 'BTC',
                'amount_paid' => 22000
            ]
        );
    }
}
