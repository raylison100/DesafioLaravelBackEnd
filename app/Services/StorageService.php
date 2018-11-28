<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 28/11/18
 * Time: 10:18
 */

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StorageService
{
    public static $instance;

    private function __construct()
    {
        self::$instance = $this;
    }

    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $path
     * @param $image
     * @return mixed
     */
    public function getImage($path, $image)
    {
        return Image::make(storage_path("app/".$path."/".$image))->response();
    }

    public function setImage($path, $request)
    {
        if ($request->hasfile('photograph') && $request->file('photograph')->isValid()) {

            $imageName = time();
            $extenstion = $request->photograph->extension();
            $nameFile = "{$imageName}.{$extenstion}";

            $request->photograph->storeAs($path, $nameFile);

            return $path.'/'.$nameFile;
        }
    }

    public function deleteImage($path)
    {
        Storage::delete($path);
    }
}