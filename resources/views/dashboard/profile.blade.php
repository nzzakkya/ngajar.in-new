@extends('layout.app')
@section('content')
@include('layout.alert')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5">
                @if(auth()->user()->detail)
                <div class="my-5 ml-5">
                    <img src="{{ asset('storage/' . auth()->user()->detail->photo) }}" alt="" class="img-thumbnail mx-auto d-block" width="200px" length="200px"><br>
                    <div class="form-group">
                    <textarea class="form-control"  rows="3" readonly>{{ auth()->user()->detail->description }}</textarea>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Profile</h1>
                    </div>

                    <form class="user" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="name" placeholder="Full Name" value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="{{ Auth::user()->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="address" placeholder="Address" value="{{ Auth::user()->address }}" disabled>
                        </div>
                        <a href="{{ route('dashboard.edit.profile') }}" class="btn btn-primary btn-block btn-user">Update Profile</a>
                        <a href="{{ route('dashboard.edit.password') }}" class="btn btn-primary btn-block btn-user">Update Password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')