<?php

namespace App\Http\Services;
use Image;
use Illuminate\Support\Facades\File;
use ImageUploaderInterface;

class ImageUploader implements ImageUploaderInterface
{
    /**
     * @parmeter $image
     * @parmeter $destination
     * resize image and upload to specific destination
     * retutn image_path
     */
    public function upload($image, $destination, $size=[150,150]):string{

        $imgName = time().'.'.$image->getClientOriginalExtension();
        $imgFile = Image::make($image->getRealPath());
        $image_path = public_path($destination).'/'.$imgName;
        $this->createDirecrotory(public_path($destination));

        $imgFile->resize($size[0], $size[1], function ($constraint) {
		    $constraint->aspectRatio();
		})->save($image_path);
        return $destination.'/'.$imgName;
    }

    public function createDirecrotory($dir) : bool
    {
        $path = $dir;
        if(!File::isDirectory($path))
            File::makeDirectory($path, 0777, true, true);
        return true;
    }
}
