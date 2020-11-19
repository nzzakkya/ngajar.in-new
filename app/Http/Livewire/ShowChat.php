<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Notifications\newMessage;
use Livewire\Component;

class ShowChat extends Component
{
    public $sender;
    public $reciever;
    public $chats;
    public $chat_message;

    public function mount()
    {
        $this->sender = auth()->user();
    }

    public function render()
    {
        $this->chats = Chat::whereIn('sender_id', [$this->sender->id, $this->reciever->id])->whereIn('reciever_id', [$this->sender->id, $this->reciever->id])->get();
        return view('livewire.show-chat');
    }

    public function send()
    {
        $this->validate([
            'chat_message' => 'required',
        ]);

        $chat = new Chat();
        $chat->reciever_id = $this->reciever->id;
        $chat->sender_id = $this->sender->id;
        $chat->chat = $this->chat_message;
        $chat->save();

        $this->reset('chat_message');
        //send notification
        $this->reciever->notify(new newMessage($chat));
    }

    public function delete($id)
    {
        $chat = Chat::find($id);
        $chat->delete();
    }
}
