<?php
namespace App\Http\Services;

class UploadImage
{
    public static function setImage($request, $dir='images')
    {
        $arrFilesImage = [];
        foreach($request->file() as $arrImages)
        {
            $imageName = 'logo_instituicao.'.$arrImages->extension();
            $arrImages->move(public_path($dir), $imageName);
            array_push($arrFilesImage, $imageName);
        }

        return $arrFilesImage;
    }
}
