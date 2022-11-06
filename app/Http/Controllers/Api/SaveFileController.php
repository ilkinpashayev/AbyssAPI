<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\RequestValidate;
use Illuminate\Http\Request;
use App\Models\FilesModel;

class SaveFileController extends Controller
{
  
    public function insertFile(RequestValidate $request){

        $validatedData = $request->validated();

        $validatedData['file'] = $request->file('file')->storeAs('local', $request->name);
        $filesModel = new FilesModel();
        $filesModel->name = $request->name;
        $filesModel->description = $request->description;
        $filesModel->type = $request->type;
        $filesModel->save();



        return response()->json([
            "Name"=>$request->name,
            "Type"=>$request->type,
            "Description"=>$request->description
        ]);
    }
}
