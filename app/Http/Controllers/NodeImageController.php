<?php

namespace App\Http\Controllers;

class NodeImageController extends Controller
{
    function resolve(string $node){
        $path = storage_path('app/public/rcp-areas/loading_'.$node.'.png');
        if(file_exists($path)){
            return response()->file($path);
        }else{
            $fallback_path = storage_path('app/public/rcp-areas/loading_0.png');
            return response()->file($fallback_path);
        }
    }
}
