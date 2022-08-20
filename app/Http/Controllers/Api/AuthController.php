<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

use Auth;

class AuthController extends Controller
{
    public function postSignup(Request $request) {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function postSignin(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function getSignout()
    {

        Auth::user()->currentAccessToken()->delete();

        return  response()->json([
            'ok' => true
        ]);
    }

}
