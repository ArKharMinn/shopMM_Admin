@extends('layouts.master');

@section('content')
    <div class="login-form">
        <h3 class="mb-3 text-center">Register</h3>
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label class="mb-1">Name</label>
                <input class="form-control" value="{{ old('name') }}" type="text" name="name">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group my-3">
                <label class="mb-1">Email</label>
                <input class="form-control" value="{{ old('email') }}" type="email" name="email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="mb-1">Address</label>
                <input class="form-control" value="{{ old('address') }}" type="text" name="address">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mt-3">
                <div class="">
                    <label class="mb-1">Gender</label>
                    <input type="radio" value="male" class="" name="gender" />Male
                    <input type="radio" value="female" class="ms-2" name="gender" />Female
                </div>
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group my-3">
                <label class="mb-1">Password</label>
                <input class="form-control" value="{{ old('password') }}" type="password" name="password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="mb-1">Confirm Password</label>
                <input class="form-control" value="{{ old('password_confirmation') }}" type="password"
                    name="password_confirmation">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="au-btn au-btn--block mt-4 au-btn--green " type="submit">register</button>

        </form>
        <p class="text-center mb-2">or</p>
        <div class="">
            <a href="/auth/google/redirect" class="nav-link ">
                <button type="submit" class="btn btn-light rounded shadow-sm p-2">
                    <img class="col-1 me-3" src="{{ asset('admin/images/google_logo.png') }}" />Sign in with Google
                </button>
            </a>
        </div>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('login') }}" class="nav-link d-inline">Sign In</a>
            </p>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
