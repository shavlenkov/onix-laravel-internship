<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

use Auth;
use App\Events\UserRegistered;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        Auth::loginUsingId($user->id);

        return redirect()
            ->route('posts.index');
    }

    public function getSignin() {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()
                ->back();
        }

        return redirect()
            ->route('posts.index');
    }

    public function getSignout()
    {
        Auth::logout();

        return redirect()
            ->route('get.signin');
    }

}
