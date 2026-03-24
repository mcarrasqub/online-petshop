{{-- Edited by Mariana Carrasquilla Botero --}}

@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>{{ __('admin.categories.list') }}</span>
        <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary">
            {{ __('admin.actions.create') }} {{ __('admin.categories.title') }}
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
                    <th>{{ __('admin.fields.created_at') }}</th>
                    <th>{{ __('admin.actions.show') }}</th>
                    <th>{{ __('admin.actions.edit') }}</th>
                    <th>{{ __('admin.actions.delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($viewData['categories'] as $category)
                    <tr>
                        <td>{{ $category->getId() }}</td>
                        <td>{{ $category->getName() }}</td>
                        <td>{{ $category->getCreatedAt() }}</td>
                        <td>
                            <a href="{{ route('admin.category.show', $category->getId()) }}" class="btn btn-sm btn-info">
                                {{ __('admin.actions.show') }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.category.edit', $category->getId()) }}" class="btn btn-sm btn-warning">
                                {{ __('admin.actions.edit') }}
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.category.destroy', $category->getId()) }}" method="POST" style="display:inline;">
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
                        <td colspan="6" class="text-center text-muted py-3">
                            {{ __('admin.categories.empty') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection