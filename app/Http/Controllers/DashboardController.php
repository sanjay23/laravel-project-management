<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Timesheet\Resource;
use App\Http\Resources\Timesheet\Collection;
use App\Services\DashboardService;
use App\Http\Requests\Timesheet\Request as TimesheetRequest;

class DashboardController extends Controller
{
    use ApiResponser;

    private $dashboardService;

    public function __construct()
    {
        $this->dashboardService =  new dashboardService;
    }
 
    public function index(Request $request)
    {
        $dashboardData = $this->dashboardService->dashboardData($request->all());
        return $this->success($dashboardData);
    }

    

}
