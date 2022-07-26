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

        $request->validate([
            'name' => 'required|min: 3|max: 10',
            'surname' => 'required|min: 3|max: 45',
            'login' => 'required|unique:users|alpha_dash|min: 3|max: 30',
            'password' => 'required|min: 8'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'login' => $request->input('login'),
            'password' => bcrypt($request->input('password'))
        ]);

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
