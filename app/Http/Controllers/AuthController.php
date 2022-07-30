<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|min: 3|max: 10',
            'surname' => 'required|min: 3|max: 45',
            'login' => 'required|unique:users|alpha_dash|min: 3|max: 30',
            'password' => 'required|min: 8'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        Auth::loginUsingId($user->id);

        return redirect()
            ->route('profile');
    }

    public function getSignin() {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {

        $request->validate([
            'login' => 'required|min: 3|max: 30',
            'password' => 'required|min: 8'
        ]);

        if (!Auth::attempt($request->only(['login', 'password']))) {
            return redirect()
                ->back();
        }

        return redirect()
            ->route('profile');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('get.signin');
    }

}
