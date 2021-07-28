<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Order;
use App\Traits\TimeTrait;
use App\Traits\StatsTrait;

class DashboardController extends Controller
{
    use StatsTrait;
    use TimeTrait;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->redirectUnauthorizedUsers();
    }

    /**
     * @return void|RedirectResponse|Redirector
     */
    public function redirectUnauthorizedUsers()
    {
        if (Auth::user()) {
            return redirect('/admin/dashboard');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return View|RedirectResponse|Redirector
     */
    public function index()
    {
        if (Auth::guard('admin')->user()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function dashboard()
    {
        $this->getOrderStats($ordersTotal, $successOrders, $pendingOrders, $failedOrders);
        $orders = Order::select(['created_at', 'price', 'status'])->get();

        $price = Product::first()->price ?? 0;

        $this->getRegistrationStats($todayRegistered, $registrationsDelta);
        $this->getSalesStats($todaySold, $deltaSold);
        $this->purchaseStats($youEarned, $deltaEarned);

        $subscriptionPlans = SubscriptionPlan::all();

        $currentTime = Carbon::now();
        $prices = Cache::get('prices');
        $dates = [];

        foreach ($prices as $key => $price) {
            $dates[] = Carbon::create($price['created_at'])->format('d M');
            $prices[$key] = $prices[$key]['amount'];
        }

        $dates = array_unique($dates);
        $currentPrice = $this->getCurrentprice();
        $btcChange = $this->getBtcChange();
        $nextUTCHour = $this->getNextUtcHour();

        //prediction
        $this->populatePredictionData(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $historicalData
        );

        try {
            $predictedPrice = $this->getPredictedPrice($activeProducts->first()->id, $nextUTCHour);
            $predictedPriceChange = $this->getPredictedPriceChange($predictedPrice);
        } catch(Exception $e) {
            $predictedPrice = 0;
            $predictedPriceChange = 0;
        }

        return view('admin.dashboard', compact(
            'ordersTotal',
            'price',
            'successOrders',
            'pendingOrders',
            'failedOrders',
            'orders',
            'todayRegistered',
            'registrationsDelta',
            'todaySold',
            'deltaSold',
            'youEarned',
            'deltaEarned',
            'subscriptionPlans',
            'currentTime',
            'prices',
            'currentPrice',
            'dates',
            'btcChange',
            'nextUTCHour',
            'historicalData',
            'actualData',
            'recordsToShow',
            'name',
            'predictedPrice',
            'predictedPriceChange')
        );
    }

    /**
     * @return View
     */
    public function products(): View
    {
        $products = Product::withSubscriptions()->get();

        return view('admin.products.view', compact('products'));
    }

    /**
     * @return View
     */
    public function prediction(): View
    {
        $this->populatePredictionData(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $historicalData
        );

        return view('admin.prediction', compact(
            'historicalData',
            'actualData',
            'recordsToShow',
            'name'
        ));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @noinspection PhpUnused
     */
    public function getBtc(Request $request): JsonResponse
    {
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        if (!$request->ajax()) {
            return response()->json('Bad Request', Response::HTTP_BAD_REQUEST);
        }
        $currentPrice = $this->getCurrentPrice();
        $btcChange = $this->getBtcChange();
        $prices = Cache::get('prices');
        // dated to display manually in graph
        foreach ($prices as $key => $price) {
            $prices[$key] = $prices[$key]['amount'];
        }

        return response()->json([
            'currentPrice' => $currentPrice,
            'btcChange'    => $btcChange,
            'series'       => $prices,
        ]);
    }

    /**
     * @param $ordersTotal
     * @param $successOrders
     * @param $pendingOrders
     * @param $failedOrders
     */
    private function getOrderStats(&$ordersTotal, &$successOrders, &$pendingOrders, &$failedOrders): void
    {
        $ordersTotal = Order::count();
        $successOrders = Order::ofStatus(Order::STATUS_SUCCESS)->count();
        $pendingOrders = Order::ofStatus(Order::STATUS_PENDING)->count();
        $failedOrders = Order::ofStatus(Order::STATUS_FAILED)->count();
    }

    /**
     * @param $youEarned
     * @param $deltaEarned
     */
    private function purchaseStats(&$youEarned, &$deltaEarned): void
    {
        $youEarned = Order::madeToday()->sum('price');
        $youEarnedLastWeek = Order::lastWeekSold()->sum('price');

        /** @noinspection PhpComposerExtensionStubsInspection */
        $deltaEarned = bcsub($youEarned, $youEarnedLastWeek);
    }
}
