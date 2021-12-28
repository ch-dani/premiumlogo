<?php


namespace App\Services;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageServices
{
    /**
     * @return string
     */
    public static function saveImage($price){
//        $png_url = "logo-" . time();
//        $path = 'user_logo/' . $png_url;

//        $data = substr(Session::get('logo'), strpos(Session::get('logo'), ',') + 1);

//        Storage::disk('public')->put($path . ".png", base64_decode($data));

//        $imagePath = public_path('/storage/' . $path . ".png");

//        $img = Image::make($imagePath);

//        $img->resize(5000, 5000, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($imagePath);


		$logo = \App\Helpers\Logo::getUserArchive($price);
		return $logo;
    }
}
