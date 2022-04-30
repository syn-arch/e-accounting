@extends('layout.app');

@section('title', 'Categories')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> Add Categories</h4>

<div class="card">
    <h5 class="card-header">
        <a href="/categories" class="btn btn-primary">Back</a>
    </h5>
    <div class="card-body">
        <form method="POST" action="{{route('categories.update', $category->id)}}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="name" name="name"
                        value="{{ old('name', $category->name) }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
