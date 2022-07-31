<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VerticalCarousel extends Component
{
   

    public $filteredImages;

    public $recievedImages;



   

    protected $listeners = ['colorSeletcted'=>'selectedColorId'];

    public function selectedColorId($colorId)
    {
       
    
        // $this->emitSelf('refresh-me');
        $filtered=array_filter($this->recievedImages,function($key) use ($colorId){
           return $key==$colorId;
        },ARRAY_FILTER_USE_KEY);

        $images=null;

        foreach($filtered as $key=>$val)
        {
            $images=$val;

        }

        //  dd($images);

        $this->filteredImages=$images;
        $this->dispatchBrowserEvent('contentChanged');
       
      
      
      
       

    }
    public function mount($images)
    {
        $filtered=[];
        $this->recievedImages=$images;
       foreach($images as $key=>$val)
       {
        array_push($filtered,$val);

       }
     
       $this->filteredImages=$filtered[0];

    }
    public function render()
    {
        return view('livewire.vertical-carousel');
    }
}
