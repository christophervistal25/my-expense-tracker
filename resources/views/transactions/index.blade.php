@extends('layouts.app')
@prepend('page-css')
    <!-- DataTables -->
    <link href="/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endprepend
@section('page-title', 'Transactions')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-0 fw-semibold">Total Expenses</p>
                            <h3 class="m-0">{{ $totalExpenses }} </h3>
                            <p class="mb-0 text-truncate text-muted">As of today</p>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
        <div class="col-md-6 col-lg-4">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-0 fw-semibold">Remaining Income</p>
                            <h3 class="m-0">{{ $remainingIncome }}</h3>
                            <p class="mb-0 text-truncate text-muted">As of today</p>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
        <div class="col-md-6 col-lg-4">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-0 fw-semibold">Total Savings</p>
                            <h3 class="m-0">{{ $totalSavings }}</h3>
                            <p class="mb-0 text-truncate text-muted">As of today</p>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <div class="fs-5">
                Overview of your transactions per month
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Month</th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Expeneses
                        </th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Income</th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Savings</th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $month => $transaction)
                        <tr>
                            <td class="text-center">{{ $month }}</td>
                            <td class="text-end">
                                {{ number_format($transaction->sum('expense'), 2, '.', ',') }} <span class="me-5"></span>
                            </td>
                            <td class="text-end">
                                {{ number_format($transaction->sortByDesc('income')?->first()?->income - $transaction->sum('expense'), 2, '.', ',') }}<span
                                    class="me-5"></span>
                            </td>
                            <td class="text-end">
                                {{ number_format($transaction->sum('savings'), 2, '.', ',') }}<span class="me-5"></span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('sheet.create') }}" class="btn btn-soft-success  mx-2">
                                    <i class="dripicons-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('page-scripts')
        <!-- Required datatable js -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables/dataTables.bootstrap5.min.js"></script>
        <script src="/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script>
            $('table').DataTable({
                ordering: false,
            });
        </script>
    @endpush
@endsection
