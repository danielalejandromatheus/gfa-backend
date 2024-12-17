<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Request $request, $file)
    {
        if (Storage::disk('local')->exists('patchdata/'.$file)) {
            // stream download file using local disk and request headers offset etcetera
            return response()->download(Storage::disk('local')->path('patchdata/'.$file));
        } else {
            return $this->errorResponse('File not found', 404);
        }
    }
}
