<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Save_photos
{
    public function save_photo($path, $photo)
    {
        $ex = $photo->getClientOriginalExtention();
        $fileName = time() . '.' . $ex;
        $photo->storeAs($path, $fileName, 'Images');
        return $fileName;
    }
}
