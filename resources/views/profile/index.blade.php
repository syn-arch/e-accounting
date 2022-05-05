@extends('layout.app')

@section('title', 'Profile')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> Edit Profile</h4>

<div class="card">
    <div class="card-body">
         @if ($message = Session::get('message'))
        <div class="alert alert-success mt-4">
            <strong>Success</strong>
            <p>{{$message}}</p>
        </div>
        @endif
        <form method="POST" action="/profile/{{$user->id}}">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="name" name="name" value="{{ old('name', $user->name) }}">
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
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="new_password">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                        placeholder="new password" name="new_password" value="{{ old('new_password', $user->new_password) }}">
                    @error('new_password')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="confirm_new_password">Confirm New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" id="confirm_new_password"
                        placeholder="confirm new password" name="confirm_new_password" value="{{ old('confirm_new_password', $user->confirm_new_password) }}">
                    @error('confirm_new_password')
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
