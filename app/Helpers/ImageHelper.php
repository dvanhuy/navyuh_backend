<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function save($folder,$file){
        return Storage::disk('minio')->put($folder, $file);
    }
}