<?php

namespace App\Http\Livewire;

use App\Models\Rating;
use Livewire\Component;

class ShowRating extends Component
{

    public $order;
    public $rating;
    public $submit;
    public $star = 1;
    public $review;

    public function mount()
    {
        $this->rating = $this->order->rating;
        if($this->rating == null){
            $this->submit = true;
        }else{
            $this->submit = false;
            $this->star = $this->rating->rating;
            $this->review = $this->rating->review;
        }
    }

    public function render()
    {
        return view('livewire.show-rating');
    }

    public function submit()
    {
        $this->validate([
            'review' => 'required'
        ]);
        $rating = new Rating();
        $rating->user_id = $this->order->mentor_id;
        $rating->order_id = $this->order->id;
        $rating->rating= $this->star;
        $rating->review = $this->review;
        $rating->save();
        return redirect()->route('dashboard.order-request', ['user' => $this->order->client]);
    }
}
