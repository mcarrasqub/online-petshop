<?php
// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Storage;
use Throwable;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Huellitas Pet Shop';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData['title'] = $product->getName().' - Huellitas Pet Shop';
        $viewData['subtitle'] = $product->getName().' - Product information';
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create product';
        $viewData['subtitle'] = 'Creation form';

        return view('product.create')->with('viewData', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        try {
            Product::create($request->only('name', 'price', 'stock', 'specie', 'description', 'category_id', 'image'));

            return redirect()
                ->route('product.index')
                ->with('status', 'Item created successfully');
        } catch (Throwable $e) {
            return redirect()
                ->route('product.index')
                ->with('status', 'Failed to create item.');
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Item successfully deleted');
    }

    public function update(StoreProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();
        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData['title'] = 'Edit product';
        $viewData['subtitle'] = 'Editing form';
        $viewData['product'] = $product;

        return view('product.edit')->with('viewData', $viewData);
    }
}
