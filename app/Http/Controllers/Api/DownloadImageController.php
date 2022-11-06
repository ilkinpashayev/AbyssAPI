<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Models\FilesModel;

class DownloadImageController extends Controller
{
    public function fileDownload(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        
        $file = Storage::disk('local')->get($request->file);
        return response($file, 200)->header('Content-Type', 'image/jpeg');
    }
}