<?php

namespace App\Http\Commands;

use App\Http\Requests\SubscriptionPlanRequest;
use App\Models\SubscriptionPlan;

class SubscriptionPlanCreateCommand
{
    /**
     * @var SubscriptionPlan
     */
    protected $subscriptionPlan;

    /**
     * @var SubscriptionPlanRequest
     */
    private $request;

    public function __construct(SubscriptionPlanRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return void
     */
    public function handle():void
    {
        $this->createEmptySubscriptionPlan()
            ->populateData()
            ->saveInDatabase()
        ;
    }

    /**
     * @return $this
     */
    private function createEmptySubscriptionPlan():self
    {
        $this->subscriptionPlan = new SubscriptionPlan;

        return $this;
    }

    /**
     * @return $this
     */
    protected function populateData():self
    {
        $this->subscriptionPlan->product_id = $this->request->get('product_id');
        $this->subscriptionPlan->price = $this->request->get('price');
        $this->subscriptionPlan->days = $this->request->get('days');

        return $this;
    }

    /**
     * @return $this
     */
    protected function saveInDatabase():self
    {
        $this->subscriptionPlan->save();

        return $this;
    }
}
