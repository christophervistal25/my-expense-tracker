<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Transaction::orderBy('date', 'ASC')->get()->groupBy(function ($transaction) {
            return $transaction->date->format('F Y');
        });
        $expenses = Transaction::sum('expense');
        $totalExpenses = number_format($expenses, 2, '.', ',');
        $totalSavings = number_format(Transaction::sum('savings'), 2, '.', ',');
        $remainingIncome = number_format(Transaction::whereMonth('date', now()->month)->whereYear('date', now()->year)->latest('income')->first()?->income - $expenses, 2, ".", ",");

        return view('transactions.index', [
            'transactions' => $data,
            'totalExpenses' => $totalExpenses,
            'totalSavings' => $totalSavings,
            'remainingIncome' => $remainingIncome,
        ]);
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(TransactionStoreRequest $request)
    {
        Transaction::create($request->all());

        return back()->with('success', 'Transaction created successfully');
    }
}
