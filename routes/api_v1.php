<?php

use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\TaskController;
use Illuminate\Support\Facades\Route;


Route::prefix('tasks')->group(function(){
    Route::apiResource('/', TaskController::class);
    Route::post('/assign/{userId}', [TaskController::class, 'assign']);
});

Route::prefix('projects')->group(function(){
    Route::apiResource('/', ProjectController::class);
});
