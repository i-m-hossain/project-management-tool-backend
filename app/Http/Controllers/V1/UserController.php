<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Services\V1\UserService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService){}
    use ApiResponser;

    public function register(RegisterRequest $request):JsonResponse
    {
        try {
            $data = $this->userService->register($request);
            return $this->success($data);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }
    public function login(LoginRequest $request):JsonResponse
    {
        try {
            $data =  $this->userService->login($request);
            return $this->success($data);
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


    public function logout(Request $request):JsonResponse
    {
        try {
            $data = $this->userService->logout($request);
            return $this->success($data);
        }catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function profile(Request $request):JsonResponse
    {
        try {
            $data = $this->userService->profile($request);
            return $this->success($data);
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function tasks(Request $request):JsonResponse
    {
        try {
            $data = $this->userService->getTasks($request->user());
            return $this->success($data);
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
