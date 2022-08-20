<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;

use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        $data['password_confirmation'] = bcrypt($data['password_confirmation']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        return response()
            ->json(['success' => true]);
    }
}
