<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRegister;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        try {
            if (!$token = auth()->attempt($validator->validated())) {
                return response()->json(['message' => 'Invalid credentials!'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token!'], 500);
        }

        $user = auth()->user();
        $token = JWTAuth::attempt($credentials);

        return response()->json(compact('user', 'token'));
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(StoreRegister $request)
    {
        $this->userService->register($request);

        return $this->login($request);
    }
}
