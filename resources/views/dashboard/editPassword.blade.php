@extends('layout.app')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
        <img src="\img\pp2.png" width=400 class="img-fluid">
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Update Your Password</h1>
                    </div>

                    <form class="user" action="{{ route('user-password.update') }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('current_password') {{ 'is-invalid' }} @enderror" name="current_password" placeholder="Current Password">
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password') {{ 'is-invalid' }} @enderror" name="password" placeholder="New Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-user btn-block" type="submit">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')