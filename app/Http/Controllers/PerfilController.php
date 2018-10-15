<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Service\FileSystemStorage;
use Illuminate\Http\Request;
use Mockery\Exception;

class PerfilController extends Controller
{


    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index() {
        return view("user.perfil");
    }

    public function update(UserRequest $request, FileSystemStorage $fileSystemStorage) {
        try {
            $request->validated();
            $user = auth()->user();
            $data = $request->except("_token");

            if (!$data["password"]) {
                unset($data["password"]);
            } else {
                $data["password"] = bcrypt($data["password"]);
            }

            if (isset($data["image"]) && $data["image"]) {
                $nameFile = $fileSystemStorage->store([
                    "id" => $user->id,
                    "directory" => "user",
                    "username" => $user->name,
                    "extension" => $request->image->extension()
                ], $request);

                if ($nameFile) {
                    $data["image"] = $nameFile;
                }
            }


            $user->update($data);

            return redirect("/perfil")
                    ->with("success", "Operation edit process success.");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }
}
