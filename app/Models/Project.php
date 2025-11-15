<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [''];
    public function users():HasMany{
        return $this->hasMany(User::class);
    }

    public function tasks():hasMany{
        return $this->hasMany(Task::class);
    }
}
