@extends('layouts.admin')

@section('content')
    <x-admin-content-wrapper>
        <x-admin-content-header :title="'Edit Product'" />
        <x-admin-content-main>
            <form action="{{ route('admin.management.product.update', ['product' => $product->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-inline">Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">{{ env('CURRENCY_SYMBOL', '$') }}</span>
                                </div>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.management.product.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </x-admin-content-main>
    </x-admin-content-wrapper>
@stop