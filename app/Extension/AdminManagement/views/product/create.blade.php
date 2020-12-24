@extends('layouts.admin')

@php
    $breadcrumb = [
        [ 'text' => 'Management' ],
        [ 'text' => 'Product', 'url' => route('admin.management.product.index') ],
        [ 'text' => 'Create' ]
];
@endphp

@section('content')
    <x-admin-content-wrapper>
        <x-admin-content-header :title="'Add New Product'" :breadcrumb="$breadcrumb" />
        <x-admin-content-main>
            <form action="{{ route('admin.management.product.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="d-inline">Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">{{ env('CURRENCY_SYMBOL', '$') }}</span>
                                                </div>
                                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', 0) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="stock" id="stock" class="form-control" min="1" value="{{ old('stock', 1) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote-editor">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Images Preview</label>
                                    <div class="images-uploader" data-input="images">
                                        <input type="file" class="images-uploader-file" accept="image/*">
                                        <div class="input-container"></div>
                                        <div class="images-container">
                                            <button type="button" class="images-uploader-add" title="Add Image">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('admin.management.product.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-admin-content-main>
    </x-admin-content-wrapper>
@stop

@push('scripts')
    <!-- Summernote -->
    <script src="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- images-uploader -->
    <script>
        function randChar(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        $('.images-uploader .images-uploader-add').on('click', function (e) {
            $('.images-uploader .images-uploader-file').click();
        });
        $('.images-uploader .images-uploader-file').on('change', function (e) {
            var inputName = $(e.target).parent().data('input');

            // clone
            var rand = randChar(5);
            var idHtml = `image-block-${rand}`;
            var html = $(`<div class="image-block ${idHtml}" data-index="1" id="${idHtml}"><img></div>`);
            var imagesContainer = $(e.target).parent().find('.images-container');
            var inputContainer = $(e.target).parent().find('.input-container');
            var btnAdd = imagesContainer.find('.images-uploader-add');
            var lastIndex = imagesContainer.find('.image-block').length || 0;
            $(html).attr("data-index", lastIndex+1);
            imagesContainer.prepend(html);

            var btnDel = $(`<button type="button" class="btn-delete"><i class="fas fa-times"></i></button>`);
            html.prepend(btnDel);
            btnDel.on('click', function (b) {
                var imgblock = imagesContainer.find(`.image-block.${idHtml}`);
                var input = inputContainer.find(`.input-${rand}`);
                console.log(imgblock)
                imgblock.remove();
                input.remove();
            });

            // preview
            var file = e.target;
            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(html).find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }

            // 
            var input = $(this);
            // $(e.target).parent().prepend($('<input type="file" class="images-uploader-file">'));
            var newInput = input.clone();
            newInput.appendTo(inputContainer);
            newInput.removeClass('images-uploader-file');
            newInput.addClass(`input-${rand}`);
            newInput.attr("name", `${inputName}[]`);
        });

        $(function () {
            $('.summernote-editor').summernote();
        });
    </script>
@endpush

@push('styles')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- images-uploader -->
    <style>
        .images-uploader .images-container {
            width: 100%;
            height: 100px;
            border: 1px solid red;
            overflow-x: auto;
            display: flex;
            align-items: center;
            padding: 5px;
        }
        .images-uploader .images-container * {
            /* display: block; */
        }
        .images-uploader .images-container .images-uploader-add {
            height: 100%;
            width: 100px;
            border: 1px solid gray;
            outline: none;
            margin-right: 5px;
        }
        .images-uploader .images-container .image-block {
            height: 100%;
            width: fit-content;
            margin-right: 5px;
            display: block;
            position: relative;
            border: 1px solid gray;
        }
        .images-uploader .images-container .image-block .btn-delete {
            position: absolute;
            top: 0;
            right: 0;
            margin-top: 3px;
            margin-right: 3px;
            font-size: 12px;
            outline: none;
            border: 1px solid gray;
            border-radius: 50%;
            background: #dc3545;
            color: white;
        }
        .images-uploader .images-container img {
            width: auto;
            height: 100%;
        }
        .images-uploader input[type=file] {
            display: none;
        }
    </style>
@endpush