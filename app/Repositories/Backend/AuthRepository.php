<?php

namespace App\Repositories\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    public function checkIfAuthenticated(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return true;
        }

        return false;
    }

    public function registerUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->account_type=$request->account_type;
        $user->blance =(Double)0;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    public function findUserByUserEamil($email)
    {
        $user = User::where('eamil', $email)->first();

        return $user;
    }

    public function findUserGet($id)
    {
        $user = User::where('id', $id)->first();

        return $user;
    }

    public function logout(Request $request)
    {
        return $request->user()->token()->revoke();
    }

}
