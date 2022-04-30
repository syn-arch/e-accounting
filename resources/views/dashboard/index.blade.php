@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <h4>Welcome Back, {{auth()->user()->name}}</h4>

    </div>
</div>
@endsection
