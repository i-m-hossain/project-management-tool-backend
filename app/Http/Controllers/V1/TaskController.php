<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\TaskRequest;
use App\Models\Task;
use App\Services\V1\TaskService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponser;
    public function __construct(private readonly TaskService $taskService){}
    /**
     * Display a listing of the resource.
     */
    public function index(TaskRequest $request)
    {
        try{
            $page = $request->get('page', 1);
            $tasks = $this->taskService->getTasks(10, $page);
            return $this->success($tasks);

        }catch (\Exception $exception){
            $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function assign(Request $request, Task $task){

    }
}
