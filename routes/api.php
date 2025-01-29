<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\CompleteTaskController;

Route::prefix('v1')->group(function(){

    Route::apiResource('/tasks', TaskController::class);

    Route::patch('/tasks/{task}/complete', CompleteTaskController::class);
    
});

Route::prefix('auth')->group(function () {

    Route::post('/login', LoginController::class);
    
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
