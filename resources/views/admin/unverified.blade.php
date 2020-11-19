@extends('layout.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Verifikasi Mentor</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="table-responsive" style="max-height: 442px;">
                <table class="table">
                    <thead class=" text-primary">
                        <th>User</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        @if($user->role == 'mentor')
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.user-detail', ['user' => $user]) }}" class="btn btn-primary">Detail</a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verify{{ $user->id }}">Verifikasi</button>
                                <div class="modal fade" id="verify{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Verifikasi akun</h6>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('dashboard.verify', ['user' => $user]) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <p>Are you sure to verify this user ?</p>
                                                    <button type="submit" class="btn btn-success">Yes</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Verifikasi Client</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="table-responsive" style="max-height: 442px;">
                <table class="table">
                    <thead class=" text-primary">
                        <th>User</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        @if($user->role == 'client')
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.user-detail', ['user' => $user]) }}" class="btn btn-primary">Detail</a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verify{{ $user->id }}">Verifikasi</button>
                                <div class="modal fade" id="verify{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Verifikasi akun</h6>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('dashboard.verify', ['user' => $user]) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <p>Are you sure to verify this user ?</p>
                                                    <button type="submit" class="btn btn-success">Yes</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection