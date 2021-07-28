<?php

namespace App\Http\Commands;

use App\Http\Requests\SubscriptionPlanRequest;
use App\Models\SubscriptionPlan;

class SubscriptionPlanUpdateCommand extends SubscriptionPlanCreateCommand
{
    /**
     * SubscriptionPlanUpdateCommand constructor.
     * @param SubscriptionPlanRequest $request
     * @param $id
     */
    public function __construct(SubscriptionPlanRequest $request, $id)
    {
        parent::__construct($request);

        $this->subscriptionPlan = SubscriptionPlan::find($id);
    }

    /**
     * @return void
     */
    public function handle():void
    {
        $this->populateData()
            ->saveInDatabase()
        ;
    }
}
