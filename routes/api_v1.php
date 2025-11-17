<?php

use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\{TaskController, UserController};
use Illuminate\Support\Facades\Route;



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);

    // tasks
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/assign/{userId}', [TaskController::class, 'assign']);

    Route::apiResource('projects', ProjectController::class);
});




