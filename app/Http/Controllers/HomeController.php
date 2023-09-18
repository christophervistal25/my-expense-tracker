<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = now();
        $transactions = Transaction::whereHas('category')->with('category')->get()->groupBy(fn ($record) => $record->category->title);
        $grouppedBills = Bills::get()->groupBy('type');
        $bill = $grouppedBills['bill']->sum('amount');
        $debt = $grouppedBills['debt']->sum('amount');
        $transactionsGrouppedByDate = Transaction::get()->groupBy(fn($record) => $record->date->format('M d'));

        return view('home', [
            'transactionsCategorized' => $transactions,
            'bills' => $bill,
            'debts' => $debt,
            'transactionsGrouppedByDate' => $transactionsGrouppedByDate,
        ]);
    }
}
