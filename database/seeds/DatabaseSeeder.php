<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(BoUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(InvoiceSeeder::class);
    }
}
