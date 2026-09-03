<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\Auth\UserService;

class UserController extends Controller
{
    private $userService = null;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserRequest $request)
    {

    }

    public function logout(Request $request)
    {

    }
}
