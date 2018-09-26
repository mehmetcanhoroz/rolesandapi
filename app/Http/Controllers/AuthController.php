<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\Role;
use App\Models\RoleGroup;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //

    public function register(RegisterFormRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function me()
    {
        return auth()->user();
    }

    public function getRoles()
    {
        if (can("api.roles.get")) {
            $roles = Role::all();
            return $roles;
        } else
            return response(["message" => "No acces to do this"], 403);
    }

    public function getMyRoles()
    {
        if (can("api.roles.get")) {
            $user = User::find(auth()->user()->id)->first();

            //return $user->roleGroup->roles;

            $roles = Role::find(15);
            return $roles;

            return $roles;
        } else
            return response(["message" => "No acces to do this"], 403);
    }
}
