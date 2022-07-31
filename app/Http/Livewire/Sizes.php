<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sizes extends Component

{
    public $recievedSizes;
    public $filteredSizes;
    public $size_id;

    public function sizeIdChanged()
    {
        $this->emit('selectedSizeId',$this->size_id);
        // $this->emit('notification');
    }
    public function mount($sizes)
    {
        $this->recievedSizes=$sizes;
        $filtered=[];
        
       foreach($sizes as $key=>$val)
       {
        array_push($filtered,$val);
       }
       $this->filteredSizes=$filtered[0];
    //    dd($this->filteredSizes[0]->id);
       $this->size_id= $this->filteredSizes[0]->id;
    //    $this->emitTo('cart-button','binded_size',$this->size_id);
       
    }

    protected $listeners = ['colorSeletcted'=>'selectedColorId'];

    public function selectedColorId($colorId)
    {
         
        $filtered=array_filter($this->recievedSizes,function($key) use ($colorId){
           return $key==$colorId;
        },ARRAY_FILTER_USE_KEY);

       

        $sizes=null;

        foreach($filtered as $key=>$val)
        {
            $sizes=$val;

        }

       

        $this->filteredSizes=$sizes;
       
        $this->dispatchBrowserEvent('contentChanged');
       
      
      
      
       

    }

   
    public function render()
    {
        return view('livewire.sizes');
    }
}
