<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tableTitle = 'My Orders';

        /** @noinspection PhpUndefinedFieldInspection */
        $userId = Auth::user()->id;
        $orders = Order::ofUser($userId)->select(['id', 'created_at', 'price', 'status'])->paginate(15);

        return view('orders.index', compact(
            'tableTitle',
                'orders'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        /** @noinspection PhpUndefinedFieldInspection */
        if ($order->user_id !== Auth::user()->id) {
            return response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return view('orders.show', compact('order'));
    }
}
