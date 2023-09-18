<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Hashids\Hashids;
use App\Models\Category;
use Carbon\CarbonPeriod;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function __invoke()
    {
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        $period = CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);

        $month = $firstDayOfMonth->get('month');
        $year = $firstDayOfMonth->get('year');
        $transactions = Transaction::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'ASC')
            ->get()
            ->groupBy(fn ($transaction) => $transaction->date->format('Y-m-d'));
        
        $categories = Category::get();
        
        return view('sheet.create', [
            'firstDayOfMonth' => $firstDayOfMonth,
            'lastDayOfMonth' => $lastDayOfMonth,
            'period' => $period,
            'categories' => $categories,
            'transactions' => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->transactionIDs as $key => $transactionID) {
            $payee   = $request->payee[$key];
            $expense = $request->expenses[$key];
            $income  = $request->income[$key];
            $savings = $request->savings[$key];

            Transaction::updateOrCreate([
                'transaction_id' => $transactionID['transactionID'],
            ], [
                'transaction_id' => $transactionID['transactionID'],
                'date'           => $payee['date'],
                'payee'          => $payee['value'],
                'income'         => (float) Str::remove(',', $income['value']),
                'savings'        => (float) Str::remove(',', $savings['value']),
                'expense'        => (float) Str::remove(',', $expense['value']),
            ]);
        }

        return response()->json(['success' => true]);
    }
}
