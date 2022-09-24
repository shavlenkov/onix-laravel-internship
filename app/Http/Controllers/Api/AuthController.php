<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

use Auth;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function postSignup(Request $request) {

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
        ]);

        $data['password'] = bcrypt($data['password']);

        $token = $this->userService->registerUser($data);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function postSignin(Request $request) {

        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $token = $this->userService->loginUser($data);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function getSignout()
    {

        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'ok' => true
        ]);
    }

}
