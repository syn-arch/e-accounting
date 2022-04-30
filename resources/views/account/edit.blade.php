@extends('layout.app')

@section('title', 'Accounts')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> Add Accounts</h4>

<div class="card">
    <h5 class="card-header">
        <a href="/accounts" class="btn btn-primary">Back</a>
    </h5>
    <div class="card-body">
        <form method="POST" action="{{route('accounts.update', $account->id)}}">
            @method('PUT')
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name"
                        name="name" value="{{ old('name', $account->name) }}">
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="id_category">Category</label>
                <div class="col-sm-10">
                    <select name="id_category" id="id_category" class="form-control @error('id_category') is-invalid @enderror">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option {{$category->id == $account->id_category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('id_category')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
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
