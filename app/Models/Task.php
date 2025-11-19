<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = ['title','description', 'status', 'user_id', 'project_id'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function project():BelongsTo{
        return $this->belongsTo(Project::class);
    }

    public function assignTask($taskId, $userId){
        return self::where('id', $taskId)
            ->update(['user_id' => $userId]);
    }
}
