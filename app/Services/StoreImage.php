<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Config;

class StoreImage
{


    protected $request;

    protected $table;

    protected $imageable_type;

    public function __construct($request, $table,$imageable_type)
    {
        $this->request = $request;
        $this->table = $table;
        $this->imageable_type=$imageable_type;
    }

    public function storeImage()
    {

        foreach ($this->request->file('images') as $image) {
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs(
                'public/images',
                $imageName,
                'local'

            );

            $image = Image::create([
                "name" => $imageName,
                "path" => Config::get("app.url") . "/" . "storage/images/$imageName",
                "imageable_id" => $this->table->id,
                'imageable_type'=>$this->imageable_type

            ]);
        }
    }
}
