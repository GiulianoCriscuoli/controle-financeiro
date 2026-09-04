<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\Auth\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userService = null;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserRequest $request) : JsonResponse
    {

    $data  = $request->validated();

    $user  = $this->userService->login($data);
    $token = $this->userService->generateToken($user);

        return response()->json([
            'message' => 'Login bem-sucedido',
            'user' => $user,
            'token' => $token
        ], 200)->cookie(
            'auth_token',
            $token,
            60 * 24 * 7,
            '/',
            null,
            false,
            true,
            false,
            'Lax'
        );

    }

    public function logout(Request $request): JsonResponse
    {
        $this->userService->logout($request->user());

        return response()->json(['message' => 'Logout realizado com sucesso.'])
            ->cookie('auth_token', null, -1, '/', null, false, true, false, 'Lax');
    }
}
