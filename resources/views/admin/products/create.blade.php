{{-- Edited by Mariana Carrasquilla Botero --}}

@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card">
  <div class="card-header">{{ __('admin.products.create') }}</div>
  <div class="card-body">
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">{{ __('admin.fields.name') }}</label>
        <input
          type="text"
          id="name"
          name="name"
          class="form-control @error('name') is-invalid @enderror"
          value="{{ old('name') }}"
          required
        >
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">{{ __('admin.fields.category') }}</label>
        <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
          <option value="">{{ __('admin.placeholders.select_category') }}</option>
          @foreach(\App\Models\Category::orderBy('name')->get() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="specie" class="form-label">{{ __('admin.fields.specie') }}</label>
        <select id="specie" name="specie" class="form-control @error('specie') is-invalid @enderror" required>
          <option value="">{{ __('admin.placeholders.select_specie') }}</option>
          <option value="dog" @selected(old('specie') == 'dog')>{{ __('admin.species.dog') }}</option>
          <option value="cat" @selected(old('specie') == 'cat')>{{ __('admin.species.cat') }}</option>
          <option value="bird" @selected(old('specie') == 'bird')>{{ __('admin.species.bird') }}</option>
          <option value="fish" @selected(old('specie') == 'fish')>{{ __('admin.species.fish') }}</option>
          <option value="rabbit" @selected(old('specie') == 'rabbit')>{{ __('admin.species.rabbit') }}</option>
          <option value="all" @selected(old('specie') == 'all')>{{ __('admin.species.all') }}</option>
        </select>
        @error('specie')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">{{ __('admin.fields.price') }}</label>
        <input
          type="number"
          id="price"
          name="price"
          min="0"
          class="form-control @error('price') is-invalid @enderror"
          value="{{ old('price') }}"
          required
        >
        @error('price')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="stock" class="form-label">{{ __('admin.fields.stock') }}</label>
        <input
          type="number"
          id="stock"
          name="stock"
          min="0"
          class="form-control @error('stock') is-invalid @enderror"
          value="{{ old('stock', 0) }}"
          required
        >
        @error('stock')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">{{ __('admin.fields.description') }}</label>
        <textarea
          id="description"
          name="description"
          rows="4"
          class="form-control @error('description') is-invalid @enderror"
        >{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">{{ __('admin.fields.image') }}</label>
        <input
          type="file"
          id="image"
          name="image"
          class="form-control @error('image') is-invalid @enderror"
          accept="image/*"
        >
        @error('image')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('admin.actions.save') }}</button>
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">{{ __('admin.actions.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection