<?php

namespace App\Services\V1;

use App\Models\Task;

class TaskService
{
    public function __construct(private Task $task){}
    public function getTasks(int $size = 100, int $page = 1){
        return $this->task::paginate($size, ['*'], 'page', $page );
    }

}
