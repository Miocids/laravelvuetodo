<?php namespace App\Services;

use Illuminate\Http\{Response};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\{AuthRepository};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\{Collection, Str};
use Illuminate\Support\Facades\{Cache, DB};

class AuthService extends AuthRepository
{
    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse|null
     * @throws \Exception
     */
    public function store(): ?JsonResponse
    {
        DB::beginTransaction();
        try {

            $payload = \request()->merge([
                'password' => Hash::make(\request()->input("password"))
            ])->toArray();

            $user = $this->saveRepository($payload);

            $token = $user->createToken("{$user->email} " . \now()->toDateTimeString())->accessToken;
            
            DB::commit();
            
            return response()->json(['token' => $token], 201);

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(): ?JsonResponse
    {
        $credentials = \request()->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'The credentials not match, please try again'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

}