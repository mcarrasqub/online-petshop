{{-- Edited by Mariana Carrasquilla Botero --}}

@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card">
  <div class="card-header">{{ __('admin.categories.create') }}</div>
  <div class="card-body">
    <form action="{{ route('admin.category.store') }}" method="POST">
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

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('admin.actions.save') }}</button>
        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">{{ __('admin.actions.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection