<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;

class UpdateAddressBtn extends Component
{

    public $user_id;

    public function mount($user_id)
    {
        $this->user_id=$user_id;

    }
    public function render()
    {
        return view('livewire.checkout.update-address-btn');
    }
}
