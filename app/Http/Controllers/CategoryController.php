<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $ViewData = [];
        $ViewData['title'] = 'Categories - Huellitas Pet Shop';
        $ViewData['subtitle'] = 'List of categories';
        $ViewData['categories'] = Category::all();

        return view('category.index')->with('ViewData', $ViewData);

    }

    public function create(): View
    {
        $ViewData = [];
        $ViewData['title'] = 'Create category';
        $ViewData['subtitle'] = 'Creation form';

        return view('category.create')->with('ViewData', $ViewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function show(string $id): View
    {
        $viewData = [];
        $category = Category::with('products')->findOrFail($id);

        $viewData['title'] = $category->name.' - Huellitas Pet Shop';
        $viewData['subtitle'] = 'Productos en la categoría: '.$category->name;
        $viewData['category'] = $category;
        $viewData['products'] = $category->products;

        return view('product.index')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $ViewData = [];
        $category = Category::findOrFail($id);
        $ViewData['title'] = 'Edit category';
        $ViewData['subtitle'] = 'Editing form';
        $ViewData['category'] = $category;

        return view('category.edit')->with('ViewData', $ViewData);
    }

    public function update(StoreCategoryRequest $request, string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();
        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
