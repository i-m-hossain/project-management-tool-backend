<?php

namespace App\Services\V1;

use App\Models\Project;

class ProjectService
{
    public function __construct(private Project $project){

    }
    public function getAllProjects()
    {
        return $this->project->getAllProjects();
    }

    public function getAllProjectsPaginated($page, $perPage){
        return $this->project->getPaginatedProjects($page, $perPage);
    }

    public function getProjectById($id){
        return $this->project->getProjectById($id);
    }

    public function getProjectBySlug($slug){
        return $this->project->getProjectBySlug($slug);
    }


    public function updateProject($request, $project)
    {
        return $project->update($request->all());
    }

    public function createProject($project)
    {
        return $this->project->createProject($project);
    }

    public function deleteProject(Project $project)
    {
        return $project->delete();
    }

    public function getUsersByProjectId($projectId)
    {
        return $this->project->getUsersByProjectId($projectId);
    }
    public function getTasksByProjectId($projectId)
    {
        return $this->project->getTasksByProjectId($projectId);
    }

    public function assignUserToProject($projectId, $userId)
    {
        return $this->project->assignUserToProject($projectId, $userId);
    }
}
