<?php

namespace App\Http\Commands;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductUpdateCommand extends ProductCreateCommand
{
    /**
     * ProductUpdateCommand constructor.
     * @param ProductRequest $request
     * @param $id
     */
    public function __construct(ProductRequest $request, $id)
    {
        parent::__construct($request);

        $this->product = Product::find($id);
    }

    /**
     * @return void
     */
    public function handle():void
    {
        $this->populateData()
            ->saveInDatabase()
            ->getPredictionData()
        ;
    }
}
