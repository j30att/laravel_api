<?php
/**
 * Created by PhpStorm.
 * User: elf
 * Date: 08.11.2018
 * Time: 20:06
 */

namespace App\Http\Services;

use App\Models\ImageAttachment;
use Illuminate\Support\Facades\Auth;

class CloudderService
{
    public static function upload()
    {
        $user = Auth::user();

        \Cloudinary::config([
            "cloud_name" => config('cloudinary.cloudName'),
            "api_key" => config('cloudinary.apiKey'),
            "api_secret" => config('cloudinary.apiSecret')
        ]);

        $image = ImageAttachment::query()->where('id', $user->image_id)->first();
        $filePath = '.' . $image->getUrl();
        $params = ["width" => 96, "height" => 96, "gravity" => "face", "radius" => "max", "crop" => "crop"];
        $q = \Cloudinary\Uploader::upload($filePath);

        return $q;
    }
}
