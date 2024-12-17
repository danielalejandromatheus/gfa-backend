<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\NodeImageController;
use Illuminate\Support\Facades\Route;

Route::get('/node-image/{node}', [NodeImageController::class, 'resolve']);

Route::get('terms-of-service', function () {
    return view('terms-of-service');
});

Route::get('privacy-policy', function () {
    return view('privacy-policy');
});
Route::get('/download/{file}', [DownloadController::class, 'download']);
// Any other view should return forbidden
Route::fallback(function () {
    return abort(403);
});
