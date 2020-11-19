@extends('layout.app')
@section('content')

@livewire('mentor-list', ['mentors' => $mentors])
@endsection