<?php

namespace App\Services\V1;

use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private User $user)
    {

    }

    public function register(RegisterRequest $request)
    {
        $user =  $this->user->createUser([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole('Developer');
        return $user;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->user->findUserByEmail($request->email);
        if(!$user || !Hash::check($request->password, $user->password)){
            throw new \Exception("Invalid credentials",401);
        }
        $token =  $user->createToken('token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return "Logged out";
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function getTasks(User $user)
    {
          return $user->tasks()->get();
    }

    public function updateRole($userId, $role)
    {
        User::find($userId)->syncRoles([$role]);
        return "User role updated successfully";
    }

    public function getUserRoleByUserId($userId){
        $user =  User::find($userId);
        if(!$user){
            throw new \Exception("User not found",401);
        }
        return $user->getRoleNames();
    }
}
