<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Products';
        $viewData['subtitle'] = 'Products list';
        $viewData['products'] = Product::all();

        return view('admin.products.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Create product';
        $viewData['subtitle'] = 'Create product';

        return view('admin.products.create')->with('viewData', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Product detail';
        $viewData['subtitle'] = 'Product detail';
        $viewData['product'] = $product;

        return view('admin.products.show')->with('viewData', $viewData);
    }

    public function edit(Product $product): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Edit product';
        $viewData['subtitle'] = 'Edit product';
        $viewData['product'] = $product;

        return view('admin.products.edit')->with('viewData', $viewData);
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
}
