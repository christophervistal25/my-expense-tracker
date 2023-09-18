<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BillsController extends Controller
{
    public function index()
    {
        $bills = Bills::orderBy('created_at', 'DESC')->get();

        return view('bills.index', [
            'bills' => $bills,
        ]);
    }

    public function create()
    {
        return view('bills.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'due_date' => 'nullable|date',
            'due_date_every' => 'nullable|date',
            'type' => 'required',
        ]);

        Bills::create([
            'name' => Str::upper($request->name),
            'amount' => $request->amount,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'type' => $request->type,
            'due_date_every' => ($request->due_date_every) ? date('jS', strtotime($request->due_date_every)) : null,
        ]);

        return back()->with('success', 'Successfully created');
    }

    public function edit(Bills $bill)
    {
        return view('bills.edit', [
            'bill' => $bill,
        ]);
    }

    public function update(Bills $bill, Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required',
            'due_date' => 'nullable|date',
            'due_date_every' => 'nullable|date',
        ]);

        $bill->update([
            'name' => Str::upper($request->name),
            'amount' => $request->amount,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'type' => $request->type,
            'due_date_every' => ($request->due_date_every) ? date('jS', strtotime($request->due_date_every)) : null,
        ]);

        return back()->with('success', 'Successfully updated');
    }

    public function destroy(Bills $bill)
    {
        $bill->delete();

        return back()->with('success', 'Successfully deleted!');
    }
}
