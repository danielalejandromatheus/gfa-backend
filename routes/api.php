<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ManifestController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/getManifestVersion', [ManifestController::class, 'getManifestVersion']);
Route::get('/getManifestFile', [ManifestController::class, 'getManifestFile']);
Route::get('/download/{file}', [DownloadController::class, 'download']);
