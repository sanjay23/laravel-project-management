<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectUser\Resource;
use App\Http\Resources\ProjectUser\Collection;
use App\Services\ProjectUserService;
use App\Http\Requests\ProjectUser\Request as ProjectUserRequest;

class ProjectUserController extends Controller
{
    use ApiResponser;

    private $projectUserService;

    public function __construct()
    {
        $this->projectUserService = new ProjectUserService;
    }
 
    

    public function index(Request $request)
    {
        $projectUsers = $this->projectUserService->collection($request->all());
        return $this->collection(new Collection($projectUsers));
    }

    public function store(ProjectUserRequest $request)
    {
        $projectUserObj = $this->projectUserService->store($request->validated());
        return $this->success($projectUserObj);
    }

    public function show(ProjectUser $projectUser)
    {
        $projectUserObj = $this->projectUserService->resource($projectUser->id);
        return $this->resource(new Resource($projectUserObj));
    }

    public function update(ProjectUser $projectUser, ProjectUserRequest $request)
    {
        $projectUserObj = $this->projectUserService->update($projectUser, $request->validated());
        return $this->success($projectUserObj);
    }

    public function destroy(ProjectUser $projectUser)
    {
        $result = $this->projectUserService->destroy($projectUser->id);
        return $this->success($result);
    }

}
