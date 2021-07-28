<?php

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Order::updateOrCreate(
            [
                'user_id' => 1,
                'product_id' => 1,
                'subscription_plan_id' => 1
            ],
            [
                'price' => 1000,
                'status' => Order::STATUS_SUCCESS,
                'active_until' => date(Invoice::DATE_TIME_FORMAT)
            ]
        );
        Order::updateOrCreate(
            [
                'user_id' => 2,
                'product_id' => 1,
                'subscription_plan_id' => 1
            ],
            [
                'price' => 900,
                'status' => Order::STATUS_PENDING,
                'active_until' => date(Invoice::DATE_TIME_FORMAT)
            ]
        );
    }
}
