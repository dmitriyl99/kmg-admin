<?php


namespace App\Helpers;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function saveImage(UploadedFile $file, $storageDirectory)
    {
        $filename = $storageDirectory . '/' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public', $filename);
        $url = Storage::url($filename);

        return compact('url', 'filename');
    }

    public static function deleteImage($filename)
    {
        Storage::disk('public')->delete($filename);
    }
}
