<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 28/11/18
 * Time: 10:13
 */

namespace App\Http\Controllers;


use App\Services\StorageService;

class StorageController
{

    private $storageService;

    function __construct()
    {
        $this->storageService = StorageService::get();
    }

    public function getImage($path, $image)
    {
        return $this->storageService->getImage($path, $image);
    }
}