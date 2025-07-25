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
use Illuminate\Support\Facades\Hash;


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
        // dd($request->validated());
        $userObj = $this->userService->update($user->id, $request->validated());
        return $this->success($userObj);
    }

    public function destroy(User $user)
    {
        $result = $this->userService->destroy($user->id);
        return $this->success($result);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully']);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

}
