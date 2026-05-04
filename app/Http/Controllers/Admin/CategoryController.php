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
        $viewData['title'] = __('admin.categories.title_index');
        $viewData['subtitle'] = __('admin.categories.list');
        $viewData['categories'] = Category::all();

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.categories.title_create');
        $viewData['subtitle'] = __('admin.categories.create');

        return view('admin.categories.create')->with('viewData', $viewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.category.index')->with('success', __('admin.messages.category_created'));
    }

    public function show(string $id): View
    {
        $category = Category::findOrFail($id);
        $viewData = [];
        $viewData['title'] = __('admin.categories.title_show');
        $viewData['subtitle'] = __('admin.categories.show');
        $viewData['category'] = $category;

        return view('admin.categories.show')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $category = Category::findOrFail($id);
        $viewData = [];
        $viewData['title'] = __('admin.categories.title_edit');
        $viewData['subtitle'] = __('admin.categories.edit');
        $viewData['category'] = $category;

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    public function update(StoreCategoryRequest $request, string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('admin.category.index')->with('success', __('admin.messages.category_updated'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', __('admin.messages.category_deleted'));
    }
}
