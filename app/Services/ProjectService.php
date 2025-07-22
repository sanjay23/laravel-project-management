<?php

namespace App\Services;

use App\Models\Project;

class ProjectService {

    private $projectModel;

    public function __construct() 
    { 
        $this->projectModel = new Project;
    }

    public  function resource($id,$inputs)
    {
        $query = $this->projectModel->getQB();
        if (is_numeric($id)) {
            $query = $query->whereId($id);
        } else {
            $query = $query->whereUuid($id);
        }
        return $query->firstOrFail();
    }

    public function collection($inputs=null)
    {
        $query = $this->projectModel->getQB();
        return (isset($inputs['limit']) && $inputs['limit'] != -1) ? $query->paginate($inputs['limit']) : $query->get();
    }

    public function store($inputs)
    {
        $project = $this->projectModel->create($inputs);
        if(!empty($inputs['user_id']) && is_array($inputs['user_id'])) {
            $project->projectUsers()->sync($inputs['user_id'] ?? []);
        }
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