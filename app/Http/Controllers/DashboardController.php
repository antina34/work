<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Traits\StatsTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use StatsTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $userId = Auth::user()->id;
        $subscriptionPlans = SubscriptionPlan::all();
        $products = Product::ofActive()->withSubscriptions()->select([
            'products.*',
            'subscription_plans.*',
            'subscription_plans.id as subscription_id'
        ])->get();

        $this->getRegistrationStats($todayRegistered, $registrationsDelta);
        $this->getSalesStats($todaySold, $deltaSold);
        $this->myPurchaseStats($userId, $youBought, $youBoughtLastWeek);

        $myOrders = Order::ofUser($userId)->where('status', '=', Order::STATUS_SUCCESS)->pluck('subscription_plan_id')->values()->toArray(); //activeOrder()->

        foreach ($subscriptionPlans as $subscriptionPlan) {
            $subscriptionPlan->canBuy = !in_array($subscriptionPlan->id, $myOrders, false);
        }

        foreach ($products as $product) {
            $product->canBuy = !in_array($product->id, $myOrders, false);
        }

        $this->populatePredictionData(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $predictionAndHistoricalData
        );

        $this->populatePredictionHistory(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $historicalData
        );

        return view('dashboard', compact(
            'subscriptionPlans',
            'products',
            'todayRegistered',
            'registrationsDelta',
            'todaySold',
            'deltaSold',
            'youBought',
            'youBoughtLastWeek',
            'predictionAndHistoricalData',
            'historicalData',
            'actualData',
            'recordsToShow',
            'name'
            )
        );
    }

    /**
     * @param $userId
     * @param $youBought
     * @param $youBoughtLastWeek
     */
    private function myPurchaseStats($userId, &$youBought, &$youBoughtLastWeek): void
    {
        $youBought = Order::ofUser($userId)->count();
        $youBoughtLastWeek = Order::ofUserLastWeek($userId)->count();
    }
}
