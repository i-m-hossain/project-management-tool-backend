<?php

use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\TaskController;
use Illuminate\Support\Facades\Route;



Route::apiResource('tasks', TaskController::class);
Route::post('tasks/assign/{userId}', [TaskController::class, 'assign']);

Route::apiResource('projects', ProjectController::class);

