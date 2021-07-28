<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Product::updateOrCreate(
            [
                'name' => 'BTC/USD',
                'historical_url' => 'http://ec2-13-53-134-125.eu-north-1.compute.amazonaws.com:5000/api/history/prediction/',
                'actual_url' => 'http://ec2-13-53-134-125.eu-north-1.compute.amazonaws.com:5000/api/history/actual/'
            ],
            ['show_last_nr' => 20, 'active' => true]
        );
    }
}
