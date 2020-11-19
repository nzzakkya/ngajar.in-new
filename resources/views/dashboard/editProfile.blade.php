@extends('layout.app')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5">
                @livewire('update-profile', ['user' => auth()->user()])
            </div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Update Your Profile</h1>
                    </div>

                    <form class="user" action="{{ route('user-profile-information.update') }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('name') {{ 'is-invalid' }} @enderror" name="name" placeholder="Full Name" value="{{ old('name') ?? Auth::user()->name }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error('email') {{ 'is-invalid' }} @enderror" name="email" placeholder="Email Address" value="{{ old('email') ?? Auth::user()->email }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('phone') {{ 'is-invalid' }} @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') ?? Auth::user()->phone }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('address') {{ 'is-invalid' }} @enderror" name="address" placeholder="Address" value="{{ old('address') ?? Auth::user()->address }}">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-user btn-block" type="submit">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')