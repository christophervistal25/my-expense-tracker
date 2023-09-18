@extends('layouts.app')
@section('page-title', 'Add New Transaction')
@section('content')
    @if (session()->has('success'))
        <div class="card bg-success border-0">
            <div class="card-body">
                <div class="card-text text-white">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                        name="date">
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="payee">Payee:</label>
                    <input type="text" class="form-control @error('payee') is-invalid @enderror" id="payee"
                        name="payee">
                    @error('payee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expense">Expense:</label>
                    <input type="number" step="0.01" class="form-control @error('expense') is-invalid @enderror"
                        id="expense" name="expense">
                    @error('expense')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="income">Income:</label>
                    <input type="number" step="0.01" class="form-control @error('income') is-invalid @enderror"
                        id="income" name="income">
                    @error('income')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="savings">Savings:</label>
                    <input type="number" step="0.01" class="form-control @error('savings') is-invalid @enderror"
                        id="savings" name="savings">
                    @error('savings')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end shadow">Submit</button>
            </form>
        </div>
    </div>
@endsection
