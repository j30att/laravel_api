<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAttachment extends Model
{
    const SALT = 'OQ80SVxUPTfazaVhszahiZx8TbwwfcjC8JB';


    const TYPE_USER_AVATAR = 'avatar';
    const TYPE_IMAGE        = 'image';


    protected $fillable = [
        'type',
        'title',
        'description',
        'code',
        'original_name',
    ];

    protected $appends = [
        'url',
    ];


    public static function generateFileName($ext)
    {
        $ext = strtolower($ext);
        do {
            $fileName = hash('md5', microtime() . self::SALT) . '.' . $ext;
            $fullFileName = self::generateFileFolder($fileName) . $fileName;
        } while (file_exists($fullFileName));
        return $fileName;
    }

    public static function generatePublicFileFolder($fileName, $mode = false)
    {
        if($mode){
            return DIRECTORY_SEPARATOR . config('app.process_attachments_path') . DIRECTORY_SEPARATOR . $mode . DIRECTORY_SEPARATOR . substr($fileName, 0, 2) . DIRECTORY_SEPARATOR;
        }else{
            return DIRECTORY_SEPARATOR . config('app.attachments_path') . DIRECTORY_SEPARATOR . substr($fileName, 0, 2) . DIRECTORY_SEPARATOR;
        }
    }

    public static function generateFileFolder($filename)
    {
        return public_path() . self::generatePublicFileFolder($filename);
    }

    public function getUrl ($type = false) {
        if (!$this->code) {
            return false;
        }
        return  self::generatePublicFileFolder($this->code, $type) . $this->code;
    }

    public function getUrlAttribute () {
        return $this->getUrl();
    }
}
