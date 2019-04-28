<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use League\Flysystem\Config;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AdminController extends Controller
{
    public function signIn(Request $request) {

        auth()->shouldUse('admins');

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('name', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ] , 401);
        }
        return response()->json([
            'token' => $token
        ],200);
    }
    public function getAdminData(Request $request) {

        auth()->shouldUse('admins');

        try {
            if (!$admin = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'error' => 'Invalid token'
                ] , 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Invalid token'
            ], 500);
        }
        return response()->json([
            'user' => $admin
        ]);
    }
}
