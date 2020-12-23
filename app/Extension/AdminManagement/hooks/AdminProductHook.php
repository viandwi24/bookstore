<?php
// use
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

// define
define('EXTENSION_NAME', 'AdminManagement');
define('EXTENSION_PRIORITY', 10);

// MANAGEMENT PRODUCT
$ext->addFilter('admin_management_product_index', function ($value, Request $request) {
    if ($request->ajax() || $request->wantsJson())
    {
        $products = Product::query();
        return DataTables::of($products)->make(true);
    }
    return view('AdminManagement::product.index');
}, EXTENSION_PRIORITY);
$ext->addFilter('admin_management_product_create', function ($value, Request $request) {
    return view('AdminManagement::product.create'); 
}, EXTENSION_PRIORITY);
$ext->addFilter('admin_management_product_store', function ($value, Request $request) {
    $request->validate([
        'name' => 'string|required|max:255|min:3',
        'price' => 'numeric|required|min:0'
    ]);
    dd($request->all());
    $product = Product::create($request->only('name', 'price'));
    return redirect()->route('admin.management.product.index');
}, EXTENSION_PRIORITY);
$ext->addFilter('admin_management_product_edit', function ($value, Request $request, $id) {
    $product = Product::findOrFail($id);
    return view('AdminManagement::product.edit', compact('product')); 
}, EXTENSION_PRIORITY);
$ext->addFilter('admin_management_product_update', function ($value, Request $request, $id) {
    $request->validate([
        'name' => 'string|required|max:255|min:3',
        'price' => 'numeric|required|min:0'
    ]);
    $product = Product::findOrFail($id);
    $update = $product->update($request->only('name', 'price'));
    return redirect()->route('admin.management.product.index');
}, EXTENSION_PRIORITY);
$ext->addFilter('admin_management_product_destroy', function ($value, Request $request, $id) {
    $product = Product::findOrFail($id);
    $delete = $product->delete();
    return redirect()->route('admin.management.product.index');
}, EXTENSION_PRIORITY);