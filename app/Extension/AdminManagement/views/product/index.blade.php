@extends('layouts.admin')

@php
    $breadcrumb = [
        [ 'text' => 'Management' ],
        [ 'text' => 'Product' ]
];
@endphp

@section('content')
    <x-admin-content-wrapper>
        <x-admin-content-header :title="'Management Product'" :breadcrumb="$breadcrumb" />
        <x-admin-content-main>
            <div class="card">
                <div class="card-header">
                    <h4 class="d-inline">Product</h4>
                    <div class="float-right">
                        <a href="{{ route('admin.management.product.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered" id="products-table">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th class="text-center">...</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </x-admin-content-main>
    </x-admin-content-wrapper>
@stop

@push('scripts')
    @include('part.datatables-scripts')
    <script>
        $("#products-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.management.product.index') }}',
            autoWidth: false,
            responsive: true,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'price', name: 'price' },
                {
                    data: null,
                    render: function ( data, type, row ) {
                        var urlEdit = "{{ route('admin.management.product.index') }}/" + data.id + "/edit";
                        var urlDetail = "{{ route('admin.management.product.index') }}/" + data.id;
                        return `
                        <div class="d-block text-center">
                            <div class="btn-group mb-3" role="group">
                                <a href="${urlEdit}" class="btn btn-sm btn-icon text-white btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" action="${urlDetail}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-icon text-white btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        `;
                    }
                }
            ]
        });
    </script>
@endpush

@push('styles')
    @include('part.datatables-styles')
@endpush