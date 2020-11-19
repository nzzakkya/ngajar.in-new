<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\User;
use App\Notifications\newMessage;
use Livewire\Component;

class MainChat extends Component
{
    public $sender;
    public $recievers;
    public $reciever_select;
    public $chats = [];
    public $chat_message;

    public function mount()
    {
        $this->sender = auth()->user();
    }

    public function render()
    {
        $this->chats = Chat::whereIn('sender_id', [$this->sender->id, $this->reciever_select])->whereIn('reciever_id', [$this->sender->id, $this->reciever_select])->get();
        if ($this->chats->isEmpty()) {
            $this->reset('reciever_select');
        }
        $this->recievers = Chat::where('reciever_id', auth()->user()->id)->orWhere('sender_id', auth()->user()->id)->groupBy('sender_id', 'reciever_id')->with('sender', 'reciever')->get(['sender_id', 'reciever_id']);
        foreach ($this->recievers as $reciever) {
            if ($reciever->reciever_id == auth()->user()->id) {
                $recievers[] = $reciever->sender;
            } else {
                $recievers[] = $reciever->reciever;
            }
        }
        if (!$this->recievers->isEmpty()) {
            $this->recievers = collect($recievers)->unique();
        }
        return view('livewire.main-chat');
    }

    public function send()
    {
        $this->validate([
            'chat_message' => 'required',
        ]);

        $chat = new Chat();
        $chat->reciever_id = $this->reciever_select;
        $chat->sender_id = $this->sender->id;
        $chat->chat = $this->chat_message;
        $chat->save();

        $this->reset('chat_message');
        //send notification
        $reciever = User::find($this->reciever_select);
        $reciever->notify(new newMessage($chat));
    }

    public function select(User $reciever)
    {
        $this->reciever_select = $reciever->id;
    }

    public function delete($id)
    {
        $chat = Chat::find($id);
        $chat->delete();
    }
}
