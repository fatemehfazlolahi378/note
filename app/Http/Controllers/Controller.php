<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $per = 10;

    public function perPage()
    {
        return \request()->has('perPage') ? \request()->get('perPage') : $this->per;
    }

    public function handleUrlStorage($files, $storagePath, $type = null, $title = null)
    {
        $path = [];

        foreach ($files as $key => $photo) {
            $url = \Storage::putFile($storagePath, $photo);
            $url = explode('/', $url);
            array_shift($url);
            $path[$key]['source'] = implode('/', $url);
            $path[$key]['type'] = $type;
            $path[$key]['title'] = $title;
        }
        return $path;
    }
}
