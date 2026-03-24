<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Categories';
        $viewData['subtitle'] = 'Categories list';
        $viewData['categories'] = Category::all();

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Create category';
        $viewData['subtitle'] = 'Create category';

        return view('admin.categories.create')->with('viewData', $viewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Category detail';
        $viewData['subtitle'] = 'Category detail';
        $viewData['category'] = $category;

        return view('admin.categories.show')->with('viewData', $viewData);
    }

    public function edit(Category $category): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Edit category';
        $viewData['subtitle'] = 'Edit category';
        $viewData['category'] = $category;

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
}
