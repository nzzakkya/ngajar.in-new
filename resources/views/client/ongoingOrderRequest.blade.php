@extends('layout.app')
@section('content')
@livewire('ongoing-order', ['order' => $order])
@endsection