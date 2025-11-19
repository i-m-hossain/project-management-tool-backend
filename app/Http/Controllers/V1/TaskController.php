<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\TaskRequest;
use App\Models\Task;
use App\Services\V1\TaskService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponser;
    public function __construct(private readonly TaskService $taskService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):JsonResponse
    {
        try{
            $page = $request->get('page', 1);
            $tasks = $this->taskService->getTasks(10, $page);
            return $this->success($tasks);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request):JsonResponse
    {
        try {
            $data = $this->taskService->storeTask($request);
            return  $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task):JsonResponse
    {
        try {
            return $this->success($task);
        }
        catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task):JsonResponse
    {
        try {
            $data = $this->taskService->updateTask($request, $task);
            return  $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task):JsonResponse
    {
        try {
            $data =  $this->taskService->deleteTask($task);
            return $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function assignTask(Request $request)
    {
        try {
            $userId = $request->userId;
            $taskId = $request->taskId;
            $data = $this->taskService->assignTask($taskId, $userId);
            return $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }


}
