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
        $query = request('search');
        $categoryId = request('category_id');

        $viewData = [];
        $viewData['title'] = __('product.title_index');
        $viewData['subtitle'] = __('product.subtitle_index');
        $viewData['products'] = Product::search($query, $categoryId);
        $viewData['categories'] = Category::orderBy('name')->get();
        $viewData['search'] = $query;
        $viewData['selectedCategory'] = $categoryId;

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $product = Product::findOrFail($id);
        $viewData = [];
        $viewData['title'] = $product->getName().' - '.__('product.store_name');
        $viewData['subtitle'] = __('product.subtitle_show', ['name' => $product->getName()]);
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }
}
