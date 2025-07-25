<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ApiResponser;

class AuthController extends Controller
{
    use ApiResponser;
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login'], 401);
        }
        $user = Auth::user(); 
        if ($user->status !== 'active') {
            return response()->json(['message' => 'User is inactive'], 403);
        }
        $token = $user->createToken('api-token')->plainTextToken;

        // return $this->success(['user' => Auth::user(),'token'=> $token]);
        return response()->json(['user' => Auth::user(),'token'=> $token]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out']);
    }

    public function user(Request $request)
    {
        return response()->json(Auth::user());
    }
}