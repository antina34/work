<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Price;

class PriceRealTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prediction:btc-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect Data from Coinbase’s API in our db and cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::debug("Prices api fetch start " . Carbon::now());
        $url = 'https://api.coinbase.com/v2/prices/spot?currency=USD';

        try {
            $apiData = $this->getApiData($url);
            $price = new Price();
            $price->base = $apiData->data->base;
            $price->currency = $apiData->data->currency;
            $price->amount = $apiData->data->amount;
            $price->save();

            Cache::forget('prices');
            Cache::rememberForever('prices', function () {
                return Price::select('amount', 'created_at')->limit(10000)->get()->toArray();
            });

            $lastPrice = Cache::get('price');
            Cache::put('price_before', $lastPrice);
            Cache::put('price', $apiData->data->amount);

        } catch (GuzzleException $exception) {
            Log::error('Error fetch data', [
                "error" => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @param string $url
     */
    private function getApiData(string $url)
    {
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('GET', '');
        return json_decode($response->getBody());
    }
}
