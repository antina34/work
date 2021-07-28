<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

trait StatsTrait
{
    /**
     * @return mixed
     */
    public function getCurrentPrice()
    {
        return Cache::get('price');
    }

    /**
     * @return mixed
     */
    public function getPreviousPrice()
    {
        return Cache::get('price_before');
    }

    /**
     * Get Predicted BTC/USD value for next hour
     *
     * @param int $productId
     * @param $nextUTCHour
     *
     * @return false|float|mixed
     */
    public function getPredictedPrice($productId, $nextUTCHour)
    {
        $currentPrice = $this->getCurrentPrice();

        try {
            $historicalData = Cache::get('historical_data_' . $productId);
            $predictedNextHour = $historicalData[0]; // the very first record

            if (Carbon::parse($predictedNextHour->date)->hour === $nextUTCHour) {
                $predictedPrice = round($predictedNextHour->price, 2);
            } else {
                $predictedPrice = round($currentPrice, 2);
            }

            return $predictedPrice;

        } catch (Exception $exception) {
            Log::error('[StatsTrait:getPredictedPrice] Error getting prediction price', [
                'error' => $exception->getMessage(),
            ]);
            return $currentPrice;
        }
    }

    /**
     * @return float|int
     */
    public function getBtcChange()
    {
        $currentPrice = $this->getCurrentPrice();
        $lastPrice =  $this->getPreviousPrice();

        return 100 - ($lastPrice*100/$currentPrice);
    }

    /**
     * @param $predictedPrice
     * @return false|float
     */
    public function getPredictedPriceChange($predictedPrice)
    {
        $currentPrice = $this->getCurrentPrice();

        return round(100-($currentPrice*100)/$predictedPrice, 2);
    }

    /**
     * @param $todayRegistered
     * @param $registrationsDelta
     */
    public function getRegistrationStats(&$todayRegistered, &$registrationsDelta): void
    {
        $todayRegistered = User::registeredToday()->count();
        $lastWeekRegistered = User::lastWeekRegistered()->count();
        $registrationsDelta = bcsub($todayRegistered, $lastWeekRegistered);
    }

    /**
     * @param $todaySold
     * @param $deltaSold
     */
    public function getSalesStats(&$todaySold, &$deltaSold): void
    {
        $todaySold = Order::madeToday()->count();
        $lastWeekSold = Order::lastWeekSold()->count();
        $deltaSold = bcsub($todaySold, $lastWeekSold);
    }

    /**
     * @param $activeProducts
     * @param $name
     * @param $recordsToShow
     * @param $actualData
     * @param $historicalData
     */
    public function populatePredictionData(&$activeProducts, &$name, &$recordsToShow, &$actualData, &$historicalData): void
    {
        $activeProducts = Product::ofActive()->get();
        $historicalData = $actualData = $recordsToShow = $name = [];

        foreach ($activeProducts as $product) {
            $historicalData[$product->id] = Cache::get('historical_data_' . $product->id);
            $actualData[$product->id] = Cache::get('actual_data_' . $product->id);
            $recordsToShow[$product->id] = $product->show_last_nr;
            $name[$product->id] = $product->name;
        }
    }

    /**
     * @param $activeProducts
     * @param $name
     * @param $recordsToShow
     * @param $actualData
     * @param $historicalData
     *
     * @return void
     */
    public function populatePredictionHistory(&$activeProducts, &$name, &$recordsToShow, &$actualData, &$historicalData): void
    {
        $this->populatePredictionData(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $historicalData
        );

        try {
            array_shift($historicalData[Product::DEFAULT_PRODUCT_ID]);
        } catch (Exception $exception) {
            Log::error('[StatTrait:populatePredictionHistory] -'.$exception);
        }
    }

    /**
     * @param $activeProducts
     * @param $chartData
     * @param $name
     * @param $recordsToShow
     * @param bool $withNextPrediction
     *
     * @return void
     */
    public function getChartData(&$activeProducts, &$chartData, &$name, &$recordsToShow, $withNextPrediction = false): void
    {
        $this->populatePredictionData(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $historicalData);

        $datesAndTimes = array_merge(
            array_column($historicalData[0], 'date'),
            array_column($actualData[0], 'date')
        );

        sort($datesAndTimes);

        foreach (array_unique($datesAndTimes) as $dateAndTime) {
            $timeMoment = collect();
            $timeMoment->time = $dateAndTime;
            if ($historicalKey = array_search($dateAndTime, array_column($historicalData[0], 'date'), true)) {
                $timeMoment->historicalPrice = $historicalData[0][$historicalKey]->price;
            }
            if ($actualKey = array_search($dateAndTime, array_column($actualData[0], 'date'), true)) {
                $timeMoment->actualPrice = $actualData[0][$actualKey]->price;
            }

            $chartData[] = $timeMoment;
        }

        if (!$withNextPrediction) {
            $chartData = array_slice($chartData, 0, -1);
        }
    }
}
