<?php

namespace App\Services;

use App\Models\Timesheet;

class TimesheetService {
    
    private $timesheetModel;
    public function __construct() 
    { 
        \Log::info('ProjectLogservice@index hit');
        $this->timesheetModel = new Timesheet;
        \Log::info('ProjectLogservice@index after hit');
    }

    public  function resource($id,$inputs)
    {
        $query = $this->timesheetModel->getQB();
        $query = $query->whereId($id);
        
        return $query->firstOrFail();
    }

    public function collection($inputs=null)
    {
        \Log::info('ProjectLogservice@collcection hit');
        $query = $this->timesheetModel->getQB();
        return (isset($inputs['limit']) && $inputs['limit'] != -1) ? $query->paginate($inputs['limit']) : $query->get();
    }

    public function store($inputs)
    {
        $project = $this->timesheetModel->create($inputs);
        return $project;
    }

    public function update($id,$inputs)
    {
        $project = $this->resource($id);
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