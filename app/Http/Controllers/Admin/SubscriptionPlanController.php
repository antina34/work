<?php

namespace App\Http\Controllers\Admin;

use App\Http\Commands\SubscriptionPlanCreateCommand;
use App\Http\Commands\SubscriptionPlanUpdateCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionPlanRequest;
use App\Models\Product;
use App\Models\SubscriptionPlan;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SubscriptionPlanController extends Controller
{
    /**
     * @var SubscriptionPlan
     */
    private $subscriptionPlanModel;

    /**
     * SubscriptionPlanController constructor.
     * @param SubscriptionPlan $subscriptionPlan
     */
    public function __construct(SubscriptionPlan $subscriptionPlan)
    {
        $this->subscriptionPlanModel = $subscriptionPlan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::all();

        return view('admin.subscription-plans.index', compact('subscriptionPlans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.subscription-plans.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubscriptionPlanRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(SubscriptionPlanRequest $request)
    {
        $this->dispatch(new SubscriptionPlanCreateCommand($request));

        return redirect('/admin/subscription-plans')->with([
            'levels'=>'success',
            'message'=>'Successfully created the subscription!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $products = Product::all();
        $subscriptionPlan = $this->subscriptionPlanModel->find($id);

        return view('admin.subscription-plans.edit', compact('subscriptionPlan', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubscriptionPlanRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(SubscriptionPlanRequest $request, $id)
    {
        $this->dispatch(new SubscriptionPlanUpdateCommand($request, $id));

        return redirect('/admin/subscription-plans')->with([
            'levels'=>'success',
            'message'=>'Successfully updated the subscription!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $subscriptionPlan = $this->subscriptionPlanModel->find($id);
        $subscriptionPlan->delete();

        return back()->with(['levels'=>'success', 'message'=>'Successfully deleted.']);
    }
}
