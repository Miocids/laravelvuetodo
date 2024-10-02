<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{AuthRegisterRequest, AuthLoginRequest};

class AuthController extends Controller
{
    public AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register(AuthRegisterRequest $request): ?JsonResponse
    {
        return $this->authService->store();
    }

    public function login(AuthLoginRequest $request): ?JsonResponse
    {
        return $this->authService->login();
    }

    public function user(Request $request): ?JsonResponse
    {
        $user = \auth()->user();
        return response()->json($user,200);
    }

    public function logout(): ?JsonResponse
    {
        \auth()->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
