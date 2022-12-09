<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function uploadImage($image, $path)
    {
        $image_name = time() . '.' . $image->extension();
        $image->move(public_path($path), $image_name);

        return $image_name;
    } //end of uploading image

    public function deleteImage($image, $path)
    {
        Storage::disk('public_images')->delete($path . $image);
    } //end of deleting image
}
