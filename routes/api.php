<?php

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('generate-transaction-code', function (Request $request) {
    $date = Carbon::parse($request->date);
    return response()->json(['transaction_id' => (string) str()->orderedUuid() . str()->remove('-', $date->format('Y-m-d'))]);
});


Route::post('category-create', function () {
    Category::create([
        'title' => request()->name,
    ]);
    return response()->json(['success' => true]);
});

Route::post('assigned-category', function () {
    Transaction::where('transaction_id', request()->transaction_id)->update([
        'category_id' => request()->category,
    ]);

    return response()->json(['success' => true]);
});

