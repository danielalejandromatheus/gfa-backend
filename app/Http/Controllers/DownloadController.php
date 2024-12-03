<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download($file)
    {
        if (Storage::disk('public')->exists($file)) {
            return response()->download(Storage::disk('public')->get($file));
        } else {
            return $this->errorResponse('File not found', 404);
        }
    }
}
