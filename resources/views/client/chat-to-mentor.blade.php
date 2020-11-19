@extends('layout.app')
@section('content')
@livewire('show-chat', ['reciever' => $user])
@endsection