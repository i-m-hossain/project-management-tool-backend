<?php

namespace App\Services\V1;

use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private User $user)
    {

    }

    public function register(RegisterRequest $request)
    {
        return $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
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

    public function profile(Request $request){
        return $request->user();
    }
}
