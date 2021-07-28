<?php

namespace App\Http\Controllers\Admin;

use App\Http\Commands\ProductCreateCommand;
use App\Http\Commands\ProductUpdateCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $productModel;

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(ProductRequest $request)
    {
        $this->dispatch(new ProductCreateCommand($request));

        return redirect('/admin/products')->with([
            'levels'=>'success',
            'message'=>'Successfully created the product!'
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
        $product = $this->productModel->find($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ProductRequest $request, $id)
    {
        $this->dispatch(new ProductUpdateCommand($request, $id));

        return redirect('/admin/products')->with([
            'levels'=>'success',
            'message'=>'Successfully updated the product!'
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
        $product = $this->productModel->with('subscriptions')->find($id);

        if (count($product->subscriptions)) {

            return back()->with([
                'levels'=>'danger',
                'message'=>'Can not delete. This product is being used by subscriptions'
            ]);
        }

        $product->delete();

        return back()->with(['levels'=>'success', 'message'=>'Successfully deleted.']);
    }
}
