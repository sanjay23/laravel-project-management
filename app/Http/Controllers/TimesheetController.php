<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Timesheet\Resource;
use App\Http\Resources\Timesheet\Collection;
use App\Services\TimesheetService;
use App\Http\Requests\Timesheet\Request as TimesheetRequest;

class TimesheetController extends Controller
{
    use ApiResponser;

    private $timesheetService;

    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }
 
    public function index(Request $request)
    {
        
        $projectLogs = $this->timesheetService->collection($request->all());
        return $this->collection(new Collection($projectLogs));
    }

    public function store(TimesheetRequest $request)
    {
        $projectLogObj = $this->timesheetService->store($request->validated());
        return $this->success($projectLogObj);
    }

    public function show(Timesheet $projectLog)
    {
        $projectLogObj = $this->timesheetService->resource($projectLog->id);
        return $this->resource(new Resource($projectLogObj));
    }

    public function update(Timesheet $projectLog, TimesheetRequest $request)
    {
        $projectLogObj = $this->timesheetService->update($projectLog->id, $request->validated());
        return $this->success($projectLogObj);
    }

    public function destroy(Timesheet $projectLog)
    {
        $result = $this->timesheetService->destroy($projectLog->id);
        return $this->success($result);
    }

}
