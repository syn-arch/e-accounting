@extends('layout.app')

@section('title', 'Users')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> Add Users</h4>

<div class="card">
    <h5 class="card-header">
        <a href="/users" class="btn btn-primary">Back</a>
    </h5>
    <div class="card-body">
        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="password">password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password"
                        name="password" value="{{ old('password') }}">
                    @error('password')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="role">role</label>
                <div class="col-sm-10">
                   <select name="role" id="role" class="form-control @error('password') is-invalid @enderror">
                          <option value="">Select Role</option>
                          <option value="admin">admin</option>
                          <option value="akuntan">akuntan</option>
                   </select>
                    @error('role')
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
