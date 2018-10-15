<?php
/**
 * Created by PhpStorm.
 * User: servidor
 * Date: 15/10/18
 * Time: 09:20
 */

namespace App\Service;


use App\Exceptions\UploadExceptions;
use Illuminate\Http\Request;

class FileSystemStorage implements Storage
{

    public function store(array $data, Request $request)
    {
        if ($request->has("image") && $request->file("image")->isValid()) {
               $nameFile = $this->getNameImage($data);

               $upload = $request->image->storeAs($data["directory"], $nameFile);

               if (!$upload) {
                    throw new UploadExceptions("Failed to the try upload file!");
               }

               return $nameFile;
        }
        return null;
    }

    private function getNameImage(array $data) {
        $name = kebab_case($data["username"]);
        return "{$data["id"]}.{$name}.{$data["extension"]}";
    }
}