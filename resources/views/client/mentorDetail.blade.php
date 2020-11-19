@extends('layout.app')
@section('content')
@include('layout.alert')

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 d-none d-lg-block">
                @if($user->detail)
                <img src="{{ asset('storage/' . $user->detail->photo) }}" alt="" class="img-thumbnail mx-auto d-block">
                @endif
            </div>
            <div class="col-lg-8">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="m-0 font-weight-bold text-primary">{{ $user->name }}</h1>
                        <span class="badge badge-pill badge-primary">{{$rating}} Star <i class="fas fa-star"></i></span>
                        @foreach ($user->skills as $skill)
                        <span class="badge badge-pill badge-primary">{{ $skill->skill }}</span>
                        @endforeach
                        <br>
                        @if($user->detail)
                        {{ $user->detail->description }}
                        @endif
                    </div> <br>
                    <div class="text-center">
                        <h3 class="m-0 font-weight-bold text-primary">Jadwal</h3><br>

                        <div class="row">
                            @forelse($schedules as $schedule)
                            <div class="col-sm-6">
                                <!-- Ukuran kolom kartu -->
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h6 font-weight-bold text-success text-uppercase mb-1">{{ $schedule->day }}</div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $schedule->hour_start }} - {{ $schedule->hour_end }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h6 font-weight-bold text-danger text-uppercase mb-1">Mentor belum menulis jadwal</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Mohon cek beberapa saat lagi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>                    
                </div>                
            </div>            
        </div>
    </div>    
</div>

@if(!$schedules->isEmpty())
@livewire('request-form', ['user' => $user, 'dates' => $dates])
@endif
@endsection