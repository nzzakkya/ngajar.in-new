<div>
    <div class="card">
        <div class="card-header">Chat Menu</div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <div class="list-group">
                        @foreach($recievers as $reciever)       
                        <button type="button" class="list-group-item list-group-item-action @if($reciever->id == $reciever_select) {{ 'active' }} @endif" wire:click="select({{ $reciever }})">{{ $reciever->name }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="col-10">
                    <div style="overflow-y:auto; height:400px" id="chat-container">
                        <div wire:poll>
                            @forelse($chats as $chat)
                            @if($chat->sender_id == $sender->id)
                            <div class="card bg-success text-white mt-1">
                                <div class="card-body">
                                    {{ $chat->chat }}
                                </div>
                                <div class="card-footer text-secondary">
                                    {{ $chat->created_at->diffForHumans() }}
                                    <button class="btn btn-sm btn-circle btn-danger float-right" wire:click="delete({{ $chat->id }})"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            @elseif($chat->reciever_id == $sender->id)
                            <div class="card bg-primary text-white mt-1">
                                <div class="card-body">
                                    {{ $chat->chat }}
                                </div>
                                <div class="card-footer text-secondary">
                                    {{ $chat->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @endif
                            @empty
                            <div class="card bg-danger text-white mt-1">
                                <div class="card-body">
                                    Chat masih kosong kayak hatimu kyaaa.. >.< </div> </div> @endforelse </div> <br>
                                       
                                </div>
                                @if($reciever_select)
                                <form action="" wire:submit.prevent="send">
                                    <div class="form-group mt-3">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" class="form-control @error('chat_message') {{ 'is-invalid' }} @enderror" wire:model="chat_message">
                                                @error('chat_message')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-success btn-block">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@section('script')
<script>
    const chat = document.getElementById("chat-container");
    function updateScroll(){
        chat.scrollTop = chat.scrollHeight;
    }
    updateScroll();
</script>
@endsection