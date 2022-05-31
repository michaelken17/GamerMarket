<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['transactionDetails', 'transactionDetails.product'])->get();
        return view('transaction', compact('transactions'));
    }
}
