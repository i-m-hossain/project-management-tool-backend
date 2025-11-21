<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'completed'];
    public function users():BelongsToMany{
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function tasks():hasMany{
        return $this->hasMany(Task::class);
    }

    public function  getAllProjects(){
        return  self::all();
    }

    public function getPaginatedProjects($page, $perPage){
        return self::paginate($perPage, ['*'], 'page', $page);
    }

    public function getProjectById($id){
        return self::where('id', $id)->first();
    }

    public function getProjectsByUserId($userId){
        return self::where('user_id', $userId)->get();
    }

    public function getProjectBySlug($slug){
        return self::where('slug', $slug)->first();
    }

    public function createProject($project){
        return self::create($project);
    }

    public function updateProject(int $projectId, object $updatedProject){
        return self::where('id', $projectId)
            ->update($updatedProject);
    }

    public function deleteProject(int $projectId){
        return self::delete($projectId);
    }

    public function getUsersByProjectId($projectId)
    {
        return Project::find($projectId)->users;

    }

    public function getTasksByProjectId($projectId)
    {
        return Project::find($projectId)->tasks;
    }

    public function assignUserToProject($projectId, $userId){
        $project =  Project::find($projectId);
        return $project->users()->syncWithoutDetaching([$userId]);
    }


}
