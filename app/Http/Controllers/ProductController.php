<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $query = request('q');
        $categoryId = request('category_id');

        $products = Product::query()
            ->when($query, function ($builder) use ($query) {
                $builder->where('name', 'like', '%'.$query.'%')
                    ->orWhere('description', 'like', '%'.$query.'%');
            })
            ->when($categoryId, function ($builder) use ($categoryId) {
                $builder->where('category_id', $categoryId);
            })
            ->get();

        $viewData = [];
        $viewData['title'] = __('product.title_index');
        $viewData['subtitle'] = __('product.subtitle_index');
        $viewData['products'] = $products;
        $viewData['categories'] = Category::orderBy('name')->get();
        $viewData['search'] = $query;
        $viewData['selectedCategory'] = $categoryId;

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(Product $product): View
    {
        $viewData = [];
        $viewData['title'] = $product->getName().' - '.__('product.store_name');
        $viewData['subtitle'] = __('product.subtitle_show', ['name' => $product->getName()]);
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }
}
