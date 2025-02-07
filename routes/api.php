<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use PhpParser\Node\Scalar\MagicConst\Dir;


require __DIR__ . '/api/v1.php';
require __DIR__. '/api/v2.php';


Route::prefix('auth')->group(function () {

    Route::post('/register', RegisterController::class);

    Route::post('/login', LoginController::class);

    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');

});

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});


