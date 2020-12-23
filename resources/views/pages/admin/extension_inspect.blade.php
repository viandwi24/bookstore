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
        <x-admin-content-header :title="'Plugin Inspect'" />
        <x-admin-content-main>
            <div class="card">
                <div class="card-header">
                    {{ $extension->config->name }}
                    <small>
                        <span class="badge {{ ($extension->active) ? "bg-success" : "bg-danger" }}">
                            {{ ($extension->active) ? "Enable" : "Disable" }}
                        </span>
                    </small>
                    <a href="{{ route('admin.extension') }}" class="btn btn-sm btn-primary float-right">< Back</a>
                </div>
                <div class="card-body">
                    <h3># Description</h3>
                    <p>{{ $extension->config->description }}</p>
            
                    <h3># Version</h3>
                    <p>v{{ $extension->config->version }}</p>
            
                    <h3># Author</h3>
                    <p>
                        <span>{{ $extension->config->author->name }}</span>
                        <small>
                            <a target="_blank" href="{{ $extension->config->author->site }}">Open Author Website</a>
                        </small>
                    </p>
            
                    <h3># Working Folder</h3>
                    <input  type="text" readonly class="form-control mb-4" value="{{ $extension->path }}">
            
                    <h3># Provider</h3>
                    <input type="text" readonly class="form-control mb-4" value="{{ "{$extension->path}/{$extension->config->provider}.php"  }}">
            
                    <h3># Lifecycle</h3>
                    <p class="mb-0">
                        <b>Loaded : </b> <span class="badge {{ ($extension->loaded) ? "bg-success" : "bg-danger" }}">
                            {{ ($extension->loaded) ? "True" : "False" }}
                        </span>
                    </p>
                    <p class="mb-0">
                        <b>Registered : </b> <span class="badge {{ ($extension->registered) ? "bg-success" : "bg-danger" }}">
                            {{ ($extension->registered) ? "True" : "False" }}
                        </span>
                    </p>
                    <p class="mb-4">
                        <b>Booted : </b> <span class="badge {{ ($extension->booted) ? "bg-success" : "bg-danger" }}">
                            {{ ($extension->booted) ? "True" : "False" }}
                        </span>
                    </p>
                </div>
                <div class="card-body" style="border-top: 1px solid rgb(185, 185, 185);">
                    <h3># Config</h3>
                    {{ (\Symfony\Component\VarDumper\VarDumper::dump($extension->config)) }}
                </div>
                <div class="card-body" style="border-top: 1px solid rgb(185, 185, 185);">
                    <h3># Error Trace ({{ count($extension->errors) }})</h3>
                    {{ (\Symfony\Component\VarDumper\VarDumper::dump($extension->errors)) }}
                </div>
                <div class="card-body" style="border-top: 1px solid rgb(185, 185, 185);">
                    @if (!$extension->active)
                    <div class="alert alert-danger">
                        Cannt Inspect Hook Action and Filter, because this extension disable.
                    </div>            
                    @endif
                    <h3># Hook Action</h3>
                    {{ (\Symfony\Component\VarDumper\VarDumper::dump($actions)) }}
                    <h3># Hook Filter</h3>
                    {{ (\Symfony\Component\VarDumper\VarDumper::dump($filters)) }}
                </div>
                <div class="card-body" style="border-top: 1px solid rgb(185, 185, 185);">
                    <h3># Dump</h3>
                    {{ (\Symfony\Component\VarDumper\VarDumper::dump($extension)) }}
                    {{-- json_encode($extension, JSON_PRETTY_PRINT, 1024) --}}
                </div>
            </div>
        </x-admin-content-main>
    </x-admin-content-wrapper>
@stop