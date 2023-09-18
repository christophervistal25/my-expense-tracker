@extends('layouts.app')
@section('page-title', 'Create New Bill')
@section('content')
    @include('includes.success')
    <div class="card">
        <div class="card-header bg-dark">&nbsp;</div>
        <div class="card-body">
            <form action="{{ route('bills.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" step="0.001" class="form-control @error('amount') is-invalid @enderror"
                        id="amount" name="amount" value="{{ old('amount') }}">
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" cols="30" rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type:</label>
                    <select name="type" class="form-select">
                        <option value="bill" {{ old('type') == 'bill' ? 'selected' : '' }}>Bill</option>
                        <option value="debt" {{ old('type') == 'debt' ? 'selected' : '' }}>Debt</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                        name="due_date" value="{{ old('due_date') }}">
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="due_date_every">Due Date Every:</label>
                    <input type="date" class="form-control @error('due_date_every') is-invalid @enderror"
                        id="due_date_every" name="due_date_every" value="{{ old('due_date_every') }}">
                    @error('due_date_every')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end btn-dark shadow shadow-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection
