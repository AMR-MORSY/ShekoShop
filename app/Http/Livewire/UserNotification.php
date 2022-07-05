<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserNotification extends Component
{
    public $display;

    public $message;

    protected $listeners=['notification'=>'getNotification'];

    public function getNotification($message=null)
    {
        if ($message!=null)
        {
            $this->display='display_block';
            $this->message=$message;

        }
      else
      {
        $this->display='display_none';

      }
      

    }
    public function mount()
    {
        $this->display='display_none';

    }
    public function render()
    {
        return view('livewire.user-notification');
    }
}
