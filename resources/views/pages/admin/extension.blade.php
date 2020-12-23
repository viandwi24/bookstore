@extends('layouts.admin')

<style>
    table.extension-table tr .action * {
        transition: all .2s ease-in-out;
        color: rgb(209, 209, 209);
    }
    table.extension-table tr:hover .action * {
        color: black;
    }
</style>

@section('content')
    <x-admin-content-wrapper>
        <x-admin-content-header :title="'Extension'" />
        <x-admin-content-main>
            <div class="card">
                <div class="card-header">
                    <h5 class="d-inline">List Extension</h5>
                    <div class="float-right">
                        <a href="{{ route('admin.extension.update') }}" class="btn btn-xs btn-warning">Update</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover extension-table mb-0">
                        <thead>
                            <tr>
                                <th>Extension</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($extensions as $extension)
                                <tr>
                                    <td>
                                        <b>{{ $extension->config->name }}</b>
                                        <div class="action">                        
                                            @if ($extension->active)
                                            <a href="{{ route('admin.extension.disable', [$extension->name]) }}">
                                                Disable
                                            </a>
                                            @else
                                            <a href="{{ route('admin.extension.enable', [$extension->name]) }}">
                                                Enable
                                            </a>                        
                                            @endif
                                            /
                                            <a href="{{ route('admin.extension.inspect', [$extension->name]) }}">
                                                Inspect
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{ $extension->config->description }}
                                        </p>
                                        <p class="mb-0">
                                            <small>
                                                <span class="badge {{ ($extension->active) ? "bg-success" : "bg-danger" }}">
                                                    {{ ($extension->active) ? "Enable" : "Disable" }}
                                                </span> |
                                                <span>Version {{ $extension->config->version }}</span> |
                                                <span>By {{ $extension->config->author->name }}</span> |
                                                <a target="_blank" href="{{ $extension->config->author->site }}">See Author Website</a>
                                            </small>
                                        </p>
                                        @if (count($extension->errors) > 0)
                                            <p style="color: red;" class="mt-0">
                                                Extension Have {{ count($extension->errors) }} error,
                                                Click "inspect" for see detail.
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-admin-content-main>
    </x-admin-content-wrapper>
@stop