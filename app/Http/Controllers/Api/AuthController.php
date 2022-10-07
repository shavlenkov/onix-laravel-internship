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

        return $this->userService->registerUser($data);

    }

    public function postSignin(Request $request) {

        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        return $this->userService->loginUser($data);

    }

    public function postSignout()
    {

        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'ok' => true
        ]);
    }

}
