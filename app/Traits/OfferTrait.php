<?php

namespace App\Traits;

trait OfferTrait{

    public function saveImage($image, $folder){
        $file_ex = $image->getClientOriginalExtension();
        $file_name = time().'.'.$file_ex;
        $path = $folder;
        $image->move($path,$file_name);

        return $file_name;
     }
}
