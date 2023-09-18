@extends('layouts.app')
@prepend('page-css')
    <link href="/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endprepend
@section('content')
    @include('includes.success')
    <div class="card">
        <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
            <div class="fs-5">
                Bills to Pay
            </div>
            <a href="{{ route('bills.create') }}"
                class="btn btn-primary shadow-dark float-end text-uppercase fw-bold btn-light">Add New Payment</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Name</th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Description
                        </th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Due Date
                        </th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Amount <span
                                class="fw-bold">&#8369;({{ number_format($bills->sum('amount'), 2, '.', ',') }})</span></th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Type
                        </th>
                        <th class="text-uppercase  bg-dark text-white border border-dark text-center fw-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                        <tr>
                            <td class="text-start fw-medium"><span class="ms-5"></span>{{ $bill->name }}</td>
                            <td class="text-start"><span class="mx-2"></span>{{ $bill->description }}</td>
                            <td class="text-start fw-bold text-dark text-uppercase">
                                <span class="ms-5"></span>
                                {{ $bill->due_date ? $bill->due_date->format('F d, Y') : 'Every ' . $bill->due_date_every . ' of month' }}
                            </td>
                            <td class="text-end fw-bold">&#8369;{{ number_format($bill->amount, 2, '.', ',') }} <span
                                    class="me-5"></span></td>
                            <td class="fw-medium text-center">
                                <span @class([
                                    'text-uppercase',
                                    'badge bg-warning' => $bill->type === 'bill',
                                    'badge bg-danger' => $bill->type === 'debt',
                                ])>{{ $bill->type }}</span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('bills.destroy', $bill->id) }}" method="POST"
                                    id="deleteBillForm-{{ $bill->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('bills.edit', $bill->id) }}"
                                        class="btn btn-soft-success  mx-2">
                                        <i class="dripicons-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-soft-danger btn-delete-bill"
                                        data-id="{{ $bill->id }}">
                                        <i class="dripicons-trash"></i>
                                    </button>
                                </form>

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

            $(document).on('click', '.btn-delete-bill', function() {
                let id = $(this).attr('data-id');
                let confirmation = confirm('Are you sure you want to delete this bill record?');
                if (confirmation) {
                    $(`#deleteBillForm-${id}`).trigger('submit');
                }
            });
        </script>
    @endpush
@endsection
