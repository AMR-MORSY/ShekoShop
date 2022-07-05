<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sizes extends Component

{
    public $recievedSizes;
    public $filteredSizes;
    public $size_name;

    public function sizeNameChanged()
    {
        $this->emit('selectedSizeName',$this->size_name);
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
       
    }

    protected $listeners = ['colorSeletcted'=>'selectedColorName'];

    public function selectedColorName($colorName)
    {
         
        $filtered=array_filter($this->recievedSizes,function($key) use ($colorName){
           return $key==$colorName;
        },ARRAY_FILTER_USE_KEY);

        $images=null;

        foreach($filtered as $key=>$val)
        {
            $images=$val;

        }

       

        $this->filteredSizes=$images;
        $this->dispatchBrowserEvent('contentChanged');
       
      
      
      
       

    }
    public function render()
    {
        return view('livewire.sizes');
    }
}
