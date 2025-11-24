<?php

namespace App\Services\V1;

use App\Events\TaskCreatedEvent;
use App\Http\Requests\V1\TaskRequest;
use App\Models\Task;

class TaskService
{
    public function __construct(private Task $task){}
    public function getTasks(int $size = 100, int $page = 1){
        return $this->task::paginate($size, ['*'], 'page', $page );
    }
    public function storeTask(TaskRequest $request){

        $task =  $this->task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request-> status ?? 1,
            'user_id' => $request->user_id ?? $request->user()->id,
            'project_id'=> $request->project_id
        ]);
        TaskCreatedEvent::dispatch($task);
        return $task;
    }

    public function updateTask(TaskRequest $request, Task $task){
        return $task->update($request->all());
    }

    public function deleteTask(Task $task){
        return $task->delete();
    }

    public function assignTask($taskId, $userId)
    {
        return $this->task->assignTask($taskId, $userId);
    }

    public function getProjectByTaskId($taskId){
        return Task::find($taskId)->project;
    }
}
