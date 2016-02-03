<?php

namespace App\Services;

use App\Obra;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Created by PhpStorm.
 * User: Tiago
 * Date: 02/02/2016
 * Time: 15:31
 */
class Foto
{

    public function uploadObra(UploadedFile $file,Obra $obra)
    {
            $fileName = $this->saveDisc($file);
            $this->createThumb($fileName);
            $foto = new \App\Foto(['foto' => $fileName]);
            $foto->user()->associate(Auth::user());
            $foto->obra()->associate($obra);
            $foto->save();
            return $foto;
    }

    private function saveDisc(UploadedFile $file)
    {
        $fileName = time() . $file->getClientOriginalName();
        $path = 'foto/';
        $file->move($path, $fileName);
        return $fileName;
    }

    private function createThumb($filename)
    {
        $patch = 'foto/miniatura/'.$filename;
        Image::make(public_path('foto/'.$filename))->fit(140,140)->save($patch);
    }


}