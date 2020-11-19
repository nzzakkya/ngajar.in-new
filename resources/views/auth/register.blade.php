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
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('name') {{ 'is-invalid' }} @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error('email') {{ 'is-invalid' }} @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user @error('password') {{ 'is-invalid' }} @enderror" name="password" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Repeat Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('phone') {{ 'is-invalid' }} @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('address') {{ 'is-invalid' }} @enderror" name="address" placeholder="Address" value="{{ old('address') }}">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="custom-select @error('role') {{ 'is-invalid' }} @enderror" name="role">
                                <option selected disabled>Register as :</option>
                                <option value="client">Client</option>
                                <option value="mentor">Mentor</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-user btn-block" type="submit">Register Account</button>
                    </form>
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection