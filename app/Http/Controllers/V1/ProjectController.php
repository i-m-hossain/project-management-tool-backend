<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ProjectRequest;
use App\Http\Requests\V1\TaskRequest;
use App\Models\Project;
use App\Services\V1\ProjectService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponser;
    public function __construct(private ProjectService $projectService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->projectService->getAllProjects();
            return $this->success($data);
        }catch(\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try{
            $project = [
                'title' => $request->title,
                'slug' => $request->slug,
                'completed' => $request ->completed,
                'description' => $request->description
            ];
            $data = $this->projectService->createProject($project);
            return $this->success($data);
        }catch(\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try{
            return $this->success($project);
        }catch(\Exception $exception){
           return  $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Project $project)
    {
        try{
            $data = $this->projectService->updateProject($request, $project);
            return  $this->success($data);
        }catch(\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try{
            $data = $this->projectService->deleteProject($project);
            return $this->success($data);
        }catch(\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function getUsersByProjectId(Request $request): JsonResponse
    {
        try {
            $projectId = $request->projectId;
            $data = $this->projectService->getUsersByProjectId($projectId);
            return $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function getTasksByProjectId(Request $request): JsonResponse
    {
        try {
            $projectId = $request->get('projectId');
            $data = $this->projectService->getTasksByProjectId($projectId);
            return $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode(), $exception);
        }

    }

    public function assignUser(Request $request)
    {
        try {
            $projectId = $request->projectId;
            $userId = $request->userId;
            $data = $this->projectService->assignUserToProject($projectId, $userId);
            return $this->success($data);
        }catch (\Exception $exception){
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }
}
