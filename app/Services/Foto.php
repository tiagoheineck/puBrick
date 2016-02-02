<?php

namespace App\Services;

use App\Obra;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\One\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Created by PhpStorm.
 * User: Tiago
 * Date: 02/02/2016
 * Time: 15:31
 */
class Foto
{


    public function upload(UploadedFile $file)
    {
        $fileName = time().$file->getClientOriginalName();
        $path = 'foto/';
        $file->move($path,$fileName);
        return $fileName;
    }


}