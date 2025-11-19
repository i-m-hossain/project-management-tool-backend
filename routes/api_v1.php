<?php

use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\{TaskController, UserController};
use Illuminate\Support\Facades\Route;



Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::get('user/tasks', [UserController::class, 'tasks']);

    // tasks
    Route::apiResource('tasks', TaskController::class);
    Route::patch('tasks/{taskId}/user/{userId}', [TaskController::class, 'assignTask']);

    Route::apiResource('projects', ProjectController::class);
    Route::get('project/{projectId}/users', [ProjectController::class, 'getUsersByProjectId']);
    Route::get('project/{projectId}/tasks', [ProjectController::class, 'getTasksByProjectId']);
    Route::post('/projects/{projectId}/users/{userId}', [ProjectController::class, 'assignUser']);

});




