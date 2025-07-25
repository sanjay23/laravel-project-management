<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role\Resource;
use App\Http\Resources\Role\Collection;
use App\Services\RoleService;

class RoleController extends Controller
{
    use ApiResponser;

    private $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService;
    }
 
    

    public function index(Request $request)
    {
        $roles = $this->roleService->collection($request->all());
        return $this->collection(new Collection($roles));
    }

}
