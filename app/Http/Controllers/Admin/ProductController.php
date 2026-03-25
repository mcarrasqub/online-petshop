<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Providers\ProductImageServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private readonly ProductImageServiceProvider $productImageService) {}

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.products.title_index');
        $viewData['subtitle'] = __('admin.products.list');
        $viewData['products'] = Product::all();

        return view('admin.products.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.products.title_create');
        $viewData['subtitle'] = __('admin.products.create');

        return view('admin.products.create')->with('viewData', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->productImageService->store($request->file('image'));
        }

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', __('admin.messages.product_created'));
    }

    public function show(Product $product): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.products.title_show');
        $viewData['subtitle'] = __('admin.products.show');
        $viewData['product'] = $product;

        return view('admin.products.show')->with('viewData', $viewData);
    }

    public function edit(Product $product): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.products.title_edit');
        $viewData['subtitle'] = __('admin.products.edit');
        $viewData['product'] = $product;

        return view('admin.products.edit')->with('viewData', $viewData);
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->productImageService->replace($product->image, $request->file('image'));
        }

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', __('admin.messages.product_updated'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', __('admin.messages.product_deleted'));
    }
}
