@extends('layouts.app')
@section('page-title', 'Transaction Sheet ' . date('F - Y'))
@section('content')
    <button class="btn btn-dark mb-2 float-end shadow-dark" id="btnAddNewCategory" data-bs-toggle="modal"
        data-bs-target="#categoryModal">New Category</button>
    <!-- Modal -->
    <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fs-5 text-white">Add New Category</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="#category">Category</label>
                        <input type="text" id="category" class="form-control category-select" value=""
                            placeholder="Enter Category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-dark" id="btnSubmitNewCategory">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="optionModal" tabindex="-1" aria-labelledby="optionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fs-5 text-white">Options</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recordCategory">Category</label>
                        <select name="recordCategory" class="form-select" id="recordCategory">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ str()->upper($category->title) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-dark" id="btnSubmitRecordCategory">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <table class="table table-bordered border table-hover">
        <thead>
            <tr>
                <th class="text-uppercase bg-dark text-white text-center border border-dark" width="2%">&nbsp;</th>
                <th class="text-uppercase bg-dark text-white text-center border border-dark" width="10%">Date</th>
                <th class="text-uppercase bg-dark text-white text-center border border-dark">Payee</th>
                <th class="text-uppercase bg-dark text-white text-center border border-dark">Expense</th>
                <th class="text-uppercase bg-dark text-white text-center border border-dark">Income</th>
                <th class="text-uppercase bg-dark text-white text-center border border-dark">Saving</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($period as $date)
                @isset($transactions[$date->format('Y-m-d')])
                    @foreach ($transactions[$date->format('Y-m-d')] as $_ => $transaction)
                        <tr>
                            <td class="text-center">
                                @if ($transaction->payee)
                                    <button class="btn btn-dark btn-sm btn-options" data-id="{{ $transaction->transaction_id }}"
                                        data-category="{{ $transaction->category_id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path
                                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                    </button>
                                @endif
                            </td>
                            <td class="text-center transaction-id-cell">
                                @isset($transactions[$date->format('Y-m-d')])
                                    <input type="text" class="form-control border-0 transaction-ids" name="date[]"
                                        data-transaction-id="{{ $transaction?->transaction_id }}"
                                        value="{{ $date->format('F d, Y') }}" readonly>
                                @else
                                    <input type="text" class="form-control border-0 transaction-ids" name="date[]"
                                        data-transaction-id="{{ (string) str()->orderedUuid() . str()->remove('-', $date->format('Y-m-d')) }}"
                                        value="{{ $date->format('F d, Y') }}" readonly>
                                @endisset
                            </td>
                            <td class="">
                                @isset($transactions[$date->format('Y-m-d')])
                                    <input type="text" class="form-control payee-fields" data-date="{{ $date->format('Y-m-d') }}"
                                        name="payee[]" value="{{ $transaction?->payee }}" placeholder="PAYEE">
                                @else
                                    <input type="text" class="form-control payee-fields"
                                        data-date="{{ $date->format('Y-m-d') }}" name="payee[]" value=""
                                        placeholder="PAYEE">
                                @endisset
                            </td>
                            <td>
                                @if ($transaction->expense != 0)
                                    <input type="text" class="form-control expense-fields text-center" name="expense[]"
                                        data-date="{{ $date->format('Y-m-d') }}"
                                        value="{{ number_format($transaction?->expense, 2, '.', ',') }}"
                                        placeholder="EXPENSE">
                                @else
                                    <input type="number" class="form-control expense-fields text-center" name="expense[]"
                                        data-date="{{ $date->format('Y-m-d') }}" value="" placeholder="EXPENSE">
                                @endif
                            </td>
                            <td>
                                @if ($transaction->income != 0)
                                    <input type="text" class="form-control income-fields text-center" name="income[]"
                                        data-income-transaction-id="{{ $transaction->transaction_id }}"
                                        data-date="{{ $date->format('Y-m-d') }}"
                                        value="{{ number_format($transaction?->income, 2, '.', ',') }}" placeholder="INCOME">
                                @else
                                    <input type="text" class="form-control income-fields text-center" name="income[]"
                                        data-date="{{ $date->format('Y-m-d') }}" value="" placeholder="INCOME">
                                @endif

                            </td>
                            <td>
                                @if ($transaction?->savings != 0)
                                    <input type="number" class="form-control savings-fields text-center" name="saving[]"
                                        data-date="{{ $date->format('Y-m-d') }}"
                                        value="{{ number_format($transaction?->savings, 2, '.', ',') }}"
                                        placeholder="SAVINGS">
                                @else
                                    <input type="number" class="form-control savings-fields text-center" name="saving[]"
                                        data-date="{{ $date->format('Y-m-d') }}" value="" placeholder="SAVINGS">
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @endisset
            @endforeach
        </tbody>
    </table>

    @push('page-scripts')
        <script>
            $(document).ready(function() {
                function fetchFieldDataStoreTo(object, field, attribute = 'data-date') {
                    $(field).each(function(key, v) {
                        if (attribute !== 'data-date') {
                            object.push({
                                transactionID: $(this).attr(attribute),
                                value: $(this).val(),
                            });
                        } else {
                            object.push({
                                date: $(this).attr('data-date'),
                                value: $(this).val(),
                            });
                        }
                    });
                    return object;
                };

                $(document).keyup(function(e) {
                    if (e.keyCode === 13 && e.key == 'Enter') {
                        let payee = [];
                        let expenses = [];
                        let income = [];
                        let savings = [];
                        let transactionIDs = [];

                        payee = fetchFieldDataStoreTo(payee, '.payee-fields');
                        expenses = fetchFieldDataStoreTo(expenses, '.expense-fields');
                        income = fetchFieldDataStoreTo(income, '.income-fields');
                        savings = fetchFieldDataStoreTo(savings, '.savings-fields');
                        transactionIDs = fetchFieldDataStoreTo(transactionIDs, '.transaction-ids',
                            'data-transaction-id');

                        $.ajax({
                            url: 'sheet',
                            method: 'POST',
                            data: {
                                transactionIDs,
                                payee,
                                expenses,
                                income,
                                savings
                            },
                            success: function(response) {
                                if (response.success) {
                                    notyf.success('Your changes have been successfully saved!');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 800);
                                }
                            }
                        });
                    }
                });

                $(document).on('keyup', '.expense-fields', function(e) {
                    if ($(this).val()) {
                        let latestIncome = 0;
                        $('[data-income-transaction-id]').each(function(k, v) {
                            if ($(this).val()) {
                                latestIncome = parseFloat($(this).val().replace(/,/g, ''));
                            }
                        });
                        if (!isNaN(parseFloat($(this).val()))) {
                            $(this).closest('tr').find('input.income-fields').val(parseFloat(latestIncome -
                                parseFloat($(this).val())).toFixed(2));
                        }
                    } else {
                        $(this).closest('tr').find('input.income-fields').val('');
                    }
                });

                $(document).on('click', '.transaction-id-cell', function() {
                    let date = $(this).children().closest('input').val();
                    let index = $(this).closest('tr').index();
                    let clonedRow = $(this).closest('tr').clone();
                    let element = $(this);
                    $.ajax({
                        url: '/api/generate-transaction-code',
                        method: 'POST',
                        data: {
                            date: date,
                        },
                        success: function(response) {
                            $(clonedRow).children().find('.transaction-ids').attr(
                                'data-transaction-id', response.transaction_id);
                            $(clonedRow).children().find('.income-fields').val('');
                            $(element).closest('tr').after(clonedRow);
                        }
                    });
                });

                $('#btnSubmitNewCategory').click(function() {
                    $.ajax({
                        url: '/api/category-create',
                        method: 'POST',
                        data: {
                            name: $('#category').val(),
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#categoryModal').modal('toggle');
                                $('#category').val('');
                                notyf.success('Your changes have been successfully saved!');
                            }
                        }
                    });
                });

                let record = "";
                $(document).on('click', '.btn-options', function() {
                    record = $(this).attr('data-id');
                    let category = $(this).attr('data-category');
                    $('#recordCategory').val(category);
                    $('#optionModal').modal('toggle');
                });

                $('#btnSubmitRecordCategory').click(function() {
                    $.ajax({
                        url: '/api/assigned-category',
                        method: 'POST',
                        data: {
                            transaction_id: record,
                            category: $('#recordCategory').val(),
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#recordCategory').val('');
                                $('#optionModal').modal('toggle');
                                notyf.success('Your changes have been successfully saved!');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
