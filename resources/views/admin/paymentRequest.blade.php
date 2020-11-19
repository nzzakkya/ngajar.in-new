@extends('layout.app')
@section('content')
@include('layout.alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Payemnt Request</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="table-responsive" style="max-height: 442px;">
                <table class="table">
                    <thead class=" text-primary">
                        <th>Mentor</th>
                        <th>Order ID</th>
                        <th>Fee</th>
                        <th>Type</th>
                        <th>Account Number</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->order_id }}</td>
                            <td>{{ $payment->fee }}</td>
                            <td>{{ $payment->user->payment->type }}</td>
                            <td>{{ $payment->user->payment->account_number }}</td>
                            <td>
                                @if($payment->status == 'requested')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#payment{{ $payment->id }}">Bayar</button>
                                <div class="modal fade" id="payment{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Pembayaran Order ke Mentor</h6>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('dashboard.payment-request.process', ['payment' => $payment]) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <p>Apakah anda sudah melakukan pembayaran ?</p>
                                                    <button type="submit" class="btn btn-success">Yes</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <button class="btn btn-success">Sukses dibayar</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection