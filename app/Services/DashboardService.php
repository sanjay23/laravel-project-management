<?php

namespace App\Services;

use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;

class DashboardService {
    
    private $timesheetModel;
    public function __construct() 
    { 
        
        $this->timesheetModel = new Timesheet;
    }

    public function dashboardData($id,$inputs = null)
    {
        $data['data'] = self::dashboardCounter();

        return $data;
    }


    public static function dashboardCounter()
    {
        $data = [];
        $data['totalLoggedHours'] = Timesheet::sum('logged_hours');
        $data['totalUnReviewHours'] = Timesheet::sum('logged_hours') - Timesheet::sum('approved_hours');
        $data['totalProjects'] = \App\Models\Project::count();
        $data['totalUsers'] = \App\Models\User::count();
        $data['totalActiveUser'] = \App\Models\User::where('status', 'active')->count();
        return $data;
    }

}