<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\TheResponse;
use Laravel\Fortify\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function register(Request $r)
    {
        try {
            $r->validate([
                'name'      => 'required|min:3|string|max:255',
                'phone'     => 'nullable|min:3|max:255',
                'username'  => 'required|min:3|string|max:255|unique:users',
                'email'     => 'required|string|email|unique:users',
                'password'  => 'required|min:3', new Password,
            ]);

            User::create([
                "name"     => $r->name,
                "phone"    => $r->phone,
                "username" => $r->username,
                "email"    => $r->email,
                "password" => Hash::make($r->password)
            ]);

            $user = User::where('email', $r->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return TheResponse::success([
                "access_token" => $tokenResult,
                "token_type" => 'Bearer',
                "user" => $user
            ], 'User Registered');
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }

    public function login(Request $r)
    {
        try {
            $r->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return TheResponse::error(['message' => 'Unauthorized'], 'Authin failed', 501);
            }

            $user = User::where('email', $r->email)->first();
            if (!Hash::check($r->password, $user->password, [])) {
                throw new \Exception("Password does not match");
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return TheResponse::success([
                "access_token" => $tokenResult,
                "token_type" => 'Bearer',
                "user" => $user
            ], 'authticated');
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }

    public function fetch(Request $r)
    {
        return TheResponse::success($r->user(), 'Data profile user berhasil di ambil');
    }

    public function update(Request $r)
    {
        try {
            $r->validate([
                'name'      => 'required|min:3|string|max:255',
                'phone'     => 'nullable|min:3|max:255',
                'username'  => 'required|min:3|string|max:255',
                'email'     => 'required|string|email',
                'password'  => 'nullable|min:3', new Password,
            ]);

            $auth = Auth::user();
            $user = User::find($auth->id);
            $user->update($r->all());

            return TheResponse::success($user, 'Berhasil Memperbaharui profile');
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }

    public function logout(Request $r)
    {
        $u = $r->user()->currentAccessToken()->delete();
        return TheResponse::success($u, 'Berhasil Logout');
    }
}
