@extends('layout.app')
@section('content')
@include('layout.alert')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 442px;">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Id Client</th>
                                <th>Id Mentor</th>
                                <th>Days</th>
                                <th>Dari Pukul</th>
                                <th>Sampai Pukul</th>
                                <th>Durasi</th>
                                <th>Biaya</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->client->name }}</td>
                                    <td>{{ $order->mentor->name }}</td>

                                    <td>{{ $order->day }} <b>({{ $diffForHumans = Carbon\Carbon::parse($order->day . ' ' . $order->hour_start)->diffForHumans() }})</b></td>
                                    <td>{{ $order->hour_start }}</td>
                                    <td>{{ $order->hour_end }}</td>
                                    <td>{{ $order->duration }}</td>
                                    <td>{{ $order->fee }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        @if($order->status == 'pending')
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteOrder{{ $order->id }}">Batal</button>
                                        <div class="modal fade" id="deleteOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="exampleModalLabel">Schedule</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('dashboard.delete-order-request', ['order' => $order]) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <p class="text-center">Are you sure want to cancel this order ?</p>
                                                            <button class="btn btn-success" type="submit">Yes</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($order->status == 'waiting payment')
                                        @livewire('pay',['order' => $order])
                                        @elseif($order->status == 'payment successful')
                                        @livewire('start-order',['order' => $order])
                                        @elseif($order->status == 'ongoing')
                                        <a href="{{ route('dashboard.ongoing-order-request', ['order' => $order]) }}" class="btn btn-primary">ongoing</a>
                                        @elseif($order->status == 'finished')
                                        @livewire('show-rating', ['order' => $order])
                                        <br>
                                        <a href="{{ route('dashboard.invoice', ['order' => $order]) }}" class="btn btn-primary">Invoice</a>
                                       
                                        @endif
                                    </td>
                                    
                                </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection