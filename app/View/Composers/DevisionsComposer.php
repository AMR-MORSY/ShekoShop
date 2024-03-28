<?php
namespace App\View\Composers;
use App\Models\Devision;
use Illuminate\View\View;



class DevisionsComposer
{
    public function compose(View $view)
    {
        $devisions=Devision::all();
        $view->with('devisions', $devisions);
    }
}