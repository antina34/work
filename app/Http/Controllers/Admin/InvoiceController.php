<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
        $tableTitle = 'Invoices';
        $showingAsAdmin = true;

        $invoices = Invoice::select([
            'id',
            'external_id',
            'currency',
            'price',
            'is_test',
            'status',
            'invoice_time',
            'expiration_time',
            'current_time_string',
            'buyer_provided_email',
            'transaction_currency',
            'amount_paid',
            'created_at',
            'updated_at'
        ])->paginate(15);

        return view('admin.invoices.index', compact('tableTitle', 'invoices', 'showingAsAdmin'));
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

        return view('admin.invoices.show', compact('invoice'));
    }
}
