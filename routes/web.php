<?php

use App\Http\Controllers\NodeImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/node-image/{node}', [NodeImageController::class, 'resolve']);

Route::get('terms-of-service', function () {
    return view('terms-of-service');
});

Route::get('privacy-policy', function () {
    return view('privacy-policy');
});
