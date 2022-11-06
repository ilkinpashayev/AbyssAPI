<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\FilesModel;




class GetFilesController extends Controller
{
    public function getAll(Request $request)
    {
        $filesModel = new FilesModel();
        $data = $filesModel->paginate(10,['name','description','type']);
        return response()->json([
         $data->Items()
        ]);
    }

    public function getOne(Request $request)
    {
        $filesModel = new FilesModel();

        $data = $filesModel->get(['name','description','type'])->first();
        $url = URL::temporarySignedRoute(
            'imagefile', now()->addSeconds(60), ['file' => $data->name]
        );

        return response()->json([
            'name' =>$data->name,
            'type' => $data->type,
            'description' => $data->description,
            'url'=> $url,
        ]);
    }

    public function view(File $file)
{
    $response = new BinaryFileResponse($file->getAbsolutePath());
    $response->headers->set('Content-Disposition', 'inline; filename="' . $file->real_filename . '"');

    return $response;
}
}
