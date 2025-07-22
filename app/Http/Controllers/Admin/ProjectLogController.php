<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectLog;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectLog\Resource;
use App\Http\Resources\ProjectLog\Collection;
use App\Services\ProjectLogService;
use App\Http\Requests\ProjectLog\Request as ProjectLogRequest;

class ProjectLogController extends Controller
{
    use ApiResponser;

    private $projectLogService;

    public function __construct()
    {
        $this->projectLogService = new ProjectLogService;
    }
 
    

    public function index(Request $request)
    {
        $projectLogs = $this->projectLogService->collection($request->all());
        return $this->collection(new Collection($projectLogs));
    }

    public function store(ProjectLogRequest $request)
    {
        $projectLogObj = $this->projectLogService->store($request->validated());
        return $this->success($projectLogObj);
    }

    public function show(ProjectLog $projectLog)
    {
        $projectLogObj = $this->projectLogService->resource($projectLog->id);
        return $this->resource(new Resource($projectLogObj));
    }

    public function update(ProjectLog $projectLog, ProjectLogRequest $request)
    {
        $projectLogObj = $this->projectLogService->update($projectLog, $request->validated());
        return $this->success($projectLogObj);
    }

    public function destroy(ProjectLog $projectLog)
    {
        $result = $this->projectLogService->destroy($projectLog->id);
        return $this->success($result);
    }

}
