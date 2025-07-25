<?php

namespace App\Services;

use App\Models\User;

class UserService {
    private $userModel;
    public function __construct() 
    { 
        $this->userModel = new User;
    }

    public  function resource($id,$inputs = null)
    {
        $query = $this->userModel->getQB();
        $query = $query->whereId($id);
        
        return $query->firstOrFail();
    }

    public function collection($inputs=null)
    {
        $query = $this->userModel->getQB();
        return (isset($inputs['limit']) && $inputs['limit'] != -1) ? $query->paginate($inputs['limit']) : $query->get();
    }

    public function store($inputs)
    {
        $user = $this->userModel->create($inputs);
        return $user;
    }

    public function update($id,$inputs)
    {
        $user = $this->resource($id);
        $user->update($inputs);
        $user = $this->resource($user->id);
        return $user;
    }

    public function destroy($id,$inputs = null)
    {
        $user = $this->resource($id, $inputs);
        $user->delete();
        $data['message'] = __('deleteAccountSuccessMessage');
        return $data;
    }

}