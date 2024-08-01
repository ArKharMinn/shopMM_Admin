@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid row p-4 rounded border shadow-md">
                        <div class="col-6 p-3 bg-white">
                            @if ($admin !== '')
                                <form action="{{ route('setting#update') }}" method="POST">
                                    @csrf
                                    <div class="">
                                        <label class="text-muted">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $admin->name }}">
                                    </div>
                                    <div class="my-3">
                                        <label class="text-muted">Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $admin->email }}">
                                    </div>
                                    @if ($admin->gender && $admin->address)
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="text-muted">Address</label>
                                                <input name="address" type="text" class="form-control"
                                                    value="{{ $admin->address }}">
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted d-block">Gender</label>
                                                @if (Auth::user()->gender == 'female')
                                                    <input type="radio" value="male" name="gender" /> Male
                                                    <input type="radio" class="ms-2" value="female" name="gender"
                                                        checked /> Female
                                                @else
                                                    <input type="radio" value="male" name="gender" checked /> Male
                                                    <input type="radio" class="ms-2" value="female" name="gender" />
                                                    Female
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="mt-5 d-flex justify-content-end">
                                        <button class="btn btn-outline-dark px-5 "><i
                                                class="fa-regular fa-pen-to-square me-3"></i>Update</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                        @if (Auth::user()->password != null || Auth::user()->password != '')
                            <div class="col-6 p-3 bg-white">
                                <h3 class="mb-5">
                                    Change Password
                                </h3>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Password is successfully changed</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="my-3">
                                    <form action="{{ route('setting#changePassword') }}" method="POST">
                                        @csrf
                                        <div class="">
                                            <label for="">Old Password</label>
                                            <input type="password" name="oldPassword"
                                                class="form-control @error('oldPassword') is-invalid @enderror" />
                                            @error('oldPassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            @if (session('notMatch'))
                                                <small class="text-danger">The credential do not match</small>
                                            @endif
                                        </div>
                                        <div class="my-2">
                                            <label for="">New Password</label>
                                            <input type="password" name="newPassword"
                                                class="form-control @error('newPassword') is-invalid @enderror" />
                                            @error('newPassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">Confirm Password</label>
                                            <input type="password" name="confirmPassword"
                                                class="form-control @error('confirmPassword') is-invalid @enderror" />
                                            @error('confirmPassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn rounded btn-block btn-success">Set
                                                New Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
