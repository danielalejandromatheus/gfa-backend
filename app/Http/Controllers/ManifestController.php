<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ManifestController extends Controller
{
    public function getManifestVersion()
    {
        $manifest = Storage::disk('public')->get('manifest.txt');
        $version = strtok($manifest, PHP_EOL);
        return $this->successResponse(['version' => $version]);
    }
    public function getManifestFile()
    {
        $manifest = Storage::disk('public')->get('manifest.txt');
        return response()->streamDownload(function () use ($manifest) {
            echo $manifest;
        }, 'manifest.txt', ['Content-Type' => 'text/plain']);
    }
}
