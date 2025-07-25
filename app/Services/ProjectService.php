<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectService {

    private $projectModel;

    public function __construct() 
    { 
        $this->projectModel = new Project;
    }

    public  function resource($id,$inputs = null)
    {
        $query = $this->projectModel->getQB();
        $query = $query->whereId($id);
        
        return $query->firstOrFail();
    }

    public function collection($inputs=null)
    {
        $auth = auth()->user();
        $role_id = $auth->role_id;
        $query = $this->projectModel->getQB();
        if($role_id !== config('site.roleArr.admin') && $role_id !== config('site.roleArr.super_admin') && $role_id !== config('site.roleArr.sales')) {
            $projectIds = array_unique($auth->projects()->pluck('project_id')->toArray());
            $query = $query->whereIn('id', $projectIds);
        }
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
        if(!empty($inputs['user_id']) && is_array($inputs['user_id'])) {
            $project->projectUsers()->sync($inputs['user_id'] ?? []);
        }
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