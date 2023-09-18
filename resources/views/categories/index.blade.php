@extends('layouts.app')
@section('page-title', 'Categories')
@prepend('page-css')
    <link href="/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endprepend
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-uppercase bg-dark text-white border border-dark text-center fw-medium">Name</th>
                <th class="text-uppercase bg-dark text-white border border-dark text-center fw-medium">Description
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="w-25 p-2">
                        <span class="ms-5 fw-bold">{{ $category->title }}</span>
                    </td>
                    <td class="p-2">{{ $category->description ?? $category->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @push('page-scripts')
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables/dataTables.bootstrap5.min.js"></script>
        <script src="/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables/responsive.bootstrap4.min.js"></script>
    @endpush
@endsection
