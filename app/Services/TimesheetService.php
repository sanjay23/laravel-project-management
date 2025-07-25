<?php

namespace App\Services;

use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;

class TimesheetService {
    
    private $timesheetModel;
    public function __construct() 
    { 
        \Log::info('ProjectLogservice@index hit');
        $this->timesheetModel = new Timesheet;
        \Log::info('ProjectLogservice@index after hit');
    }

    public function resource($id,$inputs = null)
    {
        $query = $this->timesheetModel->getQB();
        $query = $query->whereId($id);
        return $query->firstOrFail();
    }

    public function collection($inputs=null)
    {
        $auth = auth()->user();
        $role_id = $auth->role_id;
        $query = $this->timesheetModel->getQB();

        if($role_id !== config('site.roleArr.admin') && $role_id !== config('site.roleArr.super_admin')) {
        
            $query = $query->where('user_id', $auth->id);
        }
        return (isset($inputs['limit']) && $inputs['limit'] != -1) ? $query->paginate($inputs['limit']) : $query->get();
    }

    public function store($inputs)
    {
        $project = $this->timesheetModel->create($inputs);
        return $project;
    }

    public function update($id,$inputs)
    {
        // dd($inputs);
        $project = $this->resource($id, $inputs);
        $project->update($inputs);
        $project = $this->resource($project->id);
        return $project;
    }

    public function destroy($id,$inputs = null)
    {
        $project = $this->resource($id, $inputs);
        $project->delete();
        $data['message'] = __('deleteAccountSuccessMessage');
        return $data;
    }

}