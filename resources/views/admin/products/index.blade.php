{{-- Edited by Mariana Carrasquilla Botero --}}

@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>{{ __('admin.products.list') }}</span>
    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary">
      {{ __('admin.actions.create') }} {{ __('admin.products.title') }}
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success m-3">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>{{ __('admin.fields.id') }}</th>
          <th>{{ __('admin.fields.name') }}</th>
          <th>{{ __('admin.fields.specie') }}</th>
          <th>{{ __('admin.fields.price') }}</th>
          <th>{{ __('admin.fields.stock') }}</th>
          <th>{{ __('admin.fields.category') }}</th>
          <th>{{ __('admin.actions.show') }}</th>
          <th>{{ __('admin.actions.edit') }}</th>
          <th>{{ __('admin.actions.delete') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse($viewData['products'] as $product)
          <tr>
            <td>{{ $product->getId() }}</td>
            <td>{{ $product->getName() }}</td>
            <td>{{ __('admin.species.' . $product->getSpecie()) }}</td>
            <td>${{ number_format($product->getPrice(), 0, ',', '.') }}</td>
            <td>{{ $product->getStock() }}</td>
            <td>{{ optional($product->getCategory())->getName() ?? __('admin.messages.uncategorized') }}</td>
            <td>
              <a href="{{ route('admin.product.show', $product->getId()) }}" class="btn btn-sm btn-info">
                {{ __('admin.actions.show') }}
              </a>
            </td>
            <td>
              <a href="{{ route('admin.product.edit', $product->getId()) }}" class="btn btn-sm btn-warning">
                {{ __('admin.actions.edit') }}
              </a>
            </td>
            <td>
              <form action="{{ route('admin.product.destroy', $product->getId()) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                  {{ __('admin.actions.delete') }}
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center text-muted py-3">
              {{ __('admin.products.empty') }}
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection