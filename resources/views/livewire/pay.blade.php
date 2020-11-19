<div>
    @if($condition == 'pay')
    <form action="" method="post" wire:submit.prevent="pay({{ $order }})">
        <button type="submit" class="btn btn-primary">Pay</button>
    </form>
    @elseif($condition == 'ongoing')
    <form action="" method="post" wire:submit.prevent="pay({{ $order }})">
        <button type="submit" class="btn btn-primary">Pay</button>
    </form>
    <button class="btn btn-warning">Segera lunasi pembayaran</button>
    @elseif($condition == 'over')
    <button class="btn btn-secondary">Order expired, pembayaran belom dilakukan</button>
    @endif
</div>