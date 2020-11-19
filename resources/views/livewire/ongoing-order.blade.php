<div>
    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <br>
                                <h1 class="m-0 font-weight-bold text-primary">Pembelajaran sedang berlangsung...</h1><br>
                                <br>

                                <div class="row">

                                    <!-- pengajar -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="card" style="width:400px">
                                                        @if($order->mentor->detail)
                                                        <img class="card-img-top" src="{{ asset('storage/' . $order->mentor->detail->photo) }}" alt="Card image" style="width:100%">
                                                        @endif
                                                        <div class="card-body">
                                                            <p class="card-text">{{ $order->mentor->name }}</p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div wire:poll>
                                            <div class="main">
                                                <h4 class="text-secondary">Countdown Timer</h4>
                                                <div id="clock">
                                                    <div><span id="hours">{{ $hours }}</span>
                                                        <p>Jam</p>
                                                    </div>
                                                    <div><span id="minutes">{{ $minutes }}</span>
                                                        <p>Menit</p>
                                                    </div>
                                                    <div><span id="seconds">{{ $seconds }}</span>
                                                        <p>Detik</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- mahasiswa -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="card" style="width:400px">
                                                        @if($order->client->detail)
                                                        <img class="card-img-top" src="{{ asset('storage/' . $order->client->detail->photo) }}" alt="Card image" style="width:100%">
                                                        @endif
                                                        <div class="card-body">
                                                            <p class="card-text">{{ $order->client->name }}</p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <a href="#" class="btn btn-primary" wire:click="stop">Stop</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>