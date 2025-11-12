<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function test(){
        $user = [
            'name' => "imran",
            "email" => "imran1@gmail.com",
            "password" => "secret"
        ];
        Cache::put('user', $user);
        return [
            "message"=> 'user created',
            "data" => Cache::get('user') 
        ];
    }
}
