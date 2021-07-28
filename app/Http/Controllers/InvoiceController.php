<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tableTitle = 'My Invoices';

        /** @noinspection PhpUndefinedFieldInspection */
        $userId = Auth::user()->id;
        $orders = Order::ofUser($userId)->get();
        $invoices = collect();
        foreach ($orders as $order) {
            $invoices[] = $order->invoice;
        }

        return view('invoices.index', compact('tableTitle', 'invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }
}
