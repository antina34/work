<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\Product;

class CollectApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prediction:get-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect Data from API in our cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info("Api is fetched at " . Carbon::now());
        $products = Product::get();

        foreach ($products as $product) {
            $newHistoricalRecords = $this->getApiData($product->historical_url.''.($product->show_last_nr+1));
            $newActualRecords = $this->getApiData($product->actual_url.''.$product->show_last_nr);

            if (count($newHistoricalRecords) === $product->show_last_nr+1) {
                Cache::forever('historical_data_' . $product->id, $newHistoricalRecords);
            }

            if (count($newActualRecords) === $product->show_last_nr) {
                Cache::forever('actual_data_' . $product->id, $newActualRecords);
            }
        }

        return true;
    }

    /**
     * @param string $url
     * @return mixed
     */
    private function getApiData(string $url) {
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('GET', '');
        return json_decode($response->getBody(), true);
    }
}
