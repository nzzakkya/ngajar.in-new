<div>
    @if($condition == 'start')
    <button class="btn btn-success" wire:click="start({{$order}})">Start</button>
    @else
    <button class="btn btn-warning">Sesi ini masih belum bisa dimulai / sudah melewati</button>
    @endif
</div>