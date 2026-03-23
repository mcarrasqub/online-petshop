{{-- Edited by Mariana Carrasquilla Botero --}}

@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card">
    <div class="card-header">{{ __('admin.categories.show') }}</div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>{{ __('admin.fields.id') }}</th>
                    <td>{{ $viewData['category']->getId() }}</td>
                </tr>
                <tr>
                    <th>{{ __('admin.fields.name') }}</th>
                    <td>{{ $viewData['category']->getName() }}</td>
                </tr>
                <tr>
                    <th>{{ __('admin.fields.created_at') }}</th>
                    <td>{{ $viewData['category']->getCreatedAt() }}</td>
                </tr>
                <tr>
                    <th>{{ __('admin.fields.updated_at') }}</th>
                    <td>{{ $viewData['category']->getUpdatedAt() }}</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.category.edit', $viewData['category']->getId()) }}" class="btn btn-warning">
                {{ __('admin.actions.edit') }}
            </a>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                {{ __('admin.actions.back') }}
            </a>
        </div>
    </div>
</div>
@endsection