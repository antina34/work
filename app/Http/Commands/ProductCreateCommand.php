<?php

namespace App\Http\Commands;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;

class ProductCreateCommand
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var ProductRequest
     */
    private $request;

    public function __construct(ProductRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return void
     */
    public function handle():void
    {
        $this->createEmptyProduct()
            ->populateData()
            ->saveInDatabase()
            ->getPredictionData()
        ;
    }

    /**
     * @return $this
     */
    private function createEmptyProduct():self
    {
        $this->product = new Product;

        return $this;
    }

    /**
     * @return $this
     */
    protected function populateData():self
    {
        $this->product->name = $this->request->get('name');
        $this->product->historical_url = $this->request->get('historical_url');
        $this->product->actual_url = $this->request->get('actual_url');
        $this->product->show_last_nr = $this->request->get('show_last_nr');
        $this->product->active = $this->request->get('active') ?? false;

        return $this;
    }

    /**
     * @return $this
     */
    protected function saveInDatabase():self
    {
        $this->product->save();

        return $this;
    }

    /**
     * @return void
     */
    protected function getPredictionData():void
    {
        Artisan::call('prediction:get-data');
    }
}
