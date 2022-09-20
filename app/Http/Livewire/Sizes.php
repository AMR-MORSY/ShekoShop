<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sizes extends Component

{
    public $recievedSizes;
    public $filteredSizes;
   
    public function mount($sizes)
    {
        $this->recievedSizes = $sizes;
        $filtered = [];

        foreach ($sizes as $key => $val) {
            array_push($filtered, $val);
        }
        $this->filteredSizes = $filtered;


     
    }

    protected $listeners = ['colorSeletcted' => 'selectedColorId'];

    public function selectedColorId($colorId)
    {


        $filtered = array_filter($this->recievedSizes, function ($key) use ($colorId) {
            return $key == $colorId;
        }, ARRAY_FILTER_USE_KEY);





        $sizes = null;
        $this->filteredSizes = [];





        foreach ($filtered as $key => $val) {
            $sizes = $val;
        }

        array_push($this->filteredSizes, $sizes);

        $this->dispatchBrowserEvent('contentChanged');

        //   dd($this->filteredSizes);





        // $this->size_id =$this->filteredSizes[0]['id'];
    }


    public function render()
    {
        return view('livewire.sizes');
    }
}
