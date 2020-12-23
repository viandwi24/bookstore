<?php

namespace Extension\AdminManagement\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Viandwi24\LaravelExtension\Facades\Hook;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return Hook::applyFilter('admin_management_product_index', '', $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Hook::applyFilter('admin_management_product_create', '', $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Hook::applyFilter('admin_management_product_store', '', $request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return Hook::applyFilter('admin_management_product_edit', '', $request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Hook::applyFilter('admin_management_product_update', '', $request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return Hook::applyFilter('admin_management_product_destroy', '', $request, $id);
    }
}
