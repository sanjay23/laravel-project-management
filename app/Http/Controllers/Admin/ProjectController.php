<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Project\Resource;
use App\Http\Resources\Project\Collection;
use App\Services\ProjectService;
use App\Http\Requests\Project\Request as ProjectRequest;

class ProjectController extends Controller
{
    use ApiResponser;

    private $projectService;

    public function __construct()
    {
        $this->projectService = new ProjectService;
    }
 
    

    public function index(Request $request)
    {
        $projects = $this->projectService->collection($request->all());
        return $this->collection(new Collection($projects));
    }

    public function store(ProjectRequest $request)
    {
        $projectObj = $this->projectService->store($request->validated());
        return $this->success($projectObj);
    }

    public function show(Project $project)
    {
        $projectObj = $this->projectService->resource($project->id);
        return $this->resource(new Resource($projectObj));
    }

    public function update(Project $project, ProjectRequest $request)
    {
        $projectObj = $this->projectService->update($project, $request->validated());
        return $this->success($projectObj);
    }

    public function destroy(Project $project)
    {
        $result = $this->projectService->destroy($project->id);
        return $this->success($result);
    }

}
