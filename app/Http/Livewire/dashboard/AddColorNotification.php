<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class AddColorNotification extends Component
{
    public $display='none',$product_id;

    protected $listeners=['display_add_color_notification'];


    public function display_add_color_notification($product_id)
    {
        $this->product_id=$product_id;
        $this->display='block';

    }

    public function goToUpdateProduct()
    {
        return redirect()->route('product_update',['product'=>$this->product_id]);
    }

    public function close()
    {
        $this->display="none";
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.dashboard.add-color-notification');
    }
}
