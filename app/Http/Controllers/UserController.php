<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Resource;
use App\Http\Resources\User\Collection;
use App\Services\UserService;
use App\Http\Requests\User\Request as UserRequest;

class UserController extends Controller
{
    use ApiResponser;

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }
 
    

    public function index(Request $request)
    {
        $users = $this->userService->collection($request->all());
        return $this->collection(new Collection($users));
    }

    public function store(UserRequest $request)
    {
        $userObj = $this->userService->store($request->validated());
        return $this->success($userObj);
    }

    public function show(User $user)
    {
        $userObj = $this->userService->resource($user->id);
        return $this->resource(new Resource($userObj));
    }

    public function update(User $user, UserRequest $request)
    {
        $userObj = $this->userService->update($user, $request->validated());
        return $this->success($userObj);
    }

    public function destroy(User $user)
    {
        $result = $this->userService->destroy($user->id);
        return $this->success($result);
    }

}
