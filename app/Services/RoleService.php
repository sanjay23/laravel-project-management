<?php

namespace App\Services;

use App\Models\Role;

class RoleService {

    private $roleModel;

    public function __construct() 
    { 
        $this->roleModel = new Role;
    }

    public  function resource($id,$inputs)
    {
        $query = $this->roleModel->getQB();
        if (is_numeric($id)) {
            $query = $query->whereId($id);
        }
        return $query->firstOrFail();
    }

    public function collection($inputs=null)
    {
        $query = $this->roleModel->getQB();
        return (isset($inputs['limit']) && $inputs['limit'] != -1) ? $query->paginate($inputs['limit']) : $query->get();
    }

    
}