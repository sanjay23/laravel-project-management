<?php

namespace App\Services;

use App\Models\ProjectUser;

class ProjectUserService {
    public function __construct( private ProjectUser $projectUserModel) {  }

public  function resource($id,$inputs)
{
    $query = $this->projectUserModel->getQB();
    if (is_numeric($id)) {
        $query = $query->whereId($id);
    } else {
        $query = $query->whereUuid($id);
    }
    return $query->firstOrFail();
}

public function collection($inputs=null)
{
    $query = $this->projectUserModel->getQB();
    return (isset($inputs['limit']) && $inputs['limit'] != -1) ? $query->paginate($inputs['limit']) : $query->get();
}

public function store($inputs)
{
    $projectUser = $this->projectUserModel->create($inputs);
    return $projectUser;
}

public function update($id,$inputs)
{
    $projectUser = $this->resource($id);
    $projectUser->update($inputs);
    $projectUser = $this->resource($projectUser->id);
    return $projectUser;
}

public function destroy($id,$inputs = null)
{
    $projectUser = $this->resource($id, $inputs);
    $projectUser->delete();
    $data['message'] = __('deleteAccountSuccessMessage');
    return $data;
}

}