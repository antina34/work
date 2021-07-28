<?php

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SubscriptionPlan::updateOrCreate(
            ['product_id' => 1],
            ['price' => 20, 'days' => 7]
        );
    }
}
