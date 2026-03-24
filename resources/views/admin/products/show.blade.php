{{-- Edited by Mariana Carrasquilla Botero --}}

@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card">
  <div class="card-header">{{ __('admin.products.show') }}</div>
  <div class="card-body">
    <div class="row g-4">
      <div class="col-md-4">
        @if($viewData['product']->getImage())
          <img
            src="{{ asset('storage/' . $viewData['product']->getImage()) }}"
            alt="{{ $viewData['product']->getName() }}"
            class="img-fluid rounded"
          >
        @else
          <div class="border rounded d-flex align-items-center justify-content-center" style="min-height: 220px;">
            <span class="text-muted">{{ __('admin.messages.no_image') }}</span>
          </div>
        @endif
      </div>

      <div class="col-md-8">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>{{ __('admin.fields.id') }}</th>
              <td>{{ $viewData['product']->getId() }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.name') }}</th>
              <td>{{ $viewData['product']->getName() }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.category') }}</th>
              <td>{{ optional($viewData['product']->getCategory())->getName() ?? __('admin.messages.uncategorized') }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.specie') }}</th>
              <td>{{ __('admin.species.' . $viewData['product']->getSpecie()) }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.price') }}</th>
              <td>${{ number_format($viewData['product']->getPrice(), 0, ',', '.') }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.stock') }}</th>
              <td>{{ $viewData['product']->getStock() }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.description') }}</th>
              <td>{{ $viewData['product']->getDescription() ?: '-' }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.created_at') }}</th>
              <td>{{ $viewData['product']->getCreatedAt() }}</td>
            </tr>
            <tr>
              <th>{{ __('admin.fields.updated_at') }}</th>
              <td>{{ $viewData['product']->getUpdatedAt() }}</td>
            </tr>
          </tbody>
        </table>

        <div class="d-flex gap-2">
          <a href="{{ route('admin.product.edit', $viewData['product']->getId()) }}" class="btn btn-warning">
            {{ __('admin.actions.edit') }}
          </a>
          <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
            {{ __('admin.actions.back') }}
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection