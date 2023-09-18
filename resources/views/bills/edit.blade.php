@extends('layouts.app')
@section('page-title', 'Edit Bill')
@section('content')
    @include('includes.success')
    <div class="card">
        <div class="card-header bg-dark">&nbsp;</div>
        <div class="card-body">
            <form action="{{ route('bills.update', $bill->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $bill->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" step="0.001" class="form-control @error('amount') is-invalid @enderror"
                        id="amount" name="amount" value="{{ old('amount', $bill->amount) }}">
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" cols="30" rows="5">{{ old('description', $bill->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type:</label>
                    <select name="type" class="form-select">
                        <option value="bill" {{ old('type', $bill->type) == 'bill' ? 'selected' : '' }}>Bill</option>
                        <option value="debt" {{ old('type', $bill->type) == 'debt' ? 'selected' : '' }}>Debt</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                        name="due_date" value="{{ old('due_date', $bill->due_date?->format('Y-m-d')) }}">
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="due_date_every">Due Date Every:</label>
                    <input type="date" class="form-control @error('due_date_every') is-invalid @enderror"
                        id="due_date_every" name="due_date_every"
                        value="{{ old('due_date_every', date('Y-' . 'm-' . (int) $bill->due_date_every)) }}">
                    @error('due_date_every')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end btn-dark shadow shadow-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection
