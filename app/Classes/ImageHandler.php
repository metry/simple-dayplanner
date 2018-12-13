<?php

namespace App\Classes;

use Intervention\Image\ImageManager;

class ImageHandler
{
    const UPLOAD_DIR = 'upload';

    public static function saveImage($image, $name, $dir, $width)
    {
        $publicUploadDir = public_path() . '/' . self::UPLOAD_DIR . '/' . $dir;
        if (!file_exists($publicUploadDir)) {
            mkdir($publicUploadDir, 0777, true);
        }

        $ext = $image->getClientOriginalExtension();
        $realpath = $image->getRealPath();
        $manager = new ImageManager();
        $image = $manager->make($realpath);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($publicUploadDir . '/' . $name. '.' . $ext);
        return $image->filename . '.' . $ext;
    }
}
