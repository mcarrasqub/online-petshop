{{-- edited by Sofia Gallo --}}

@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card">
 <div class="card-header">
  {{ __('admin.home.card_title') }}
 </div>
 <div class="card-body">
  {{ __('admin.home.welcome') }}
 </div>
</div>
@endsection
