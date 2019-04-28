<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Notifications\VerifyAccount;
use App\Notifications\ResetPassword;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;


class UserController extends Controller
{
    public function signUp(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|regex:/[0-9]{9}/|unique:users',
            'email' => 'email|unique:users|required',
            'password' => 'required'
        ]);
        $user = new User([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'token' => str_random(50),
        ]);
        $user->save();
        $user->notify(new VerifyAccount($user));
        return response()->json([
            'message' => 'User created'
        ],201);
    }
    public function verify($token) {
        $user = User::where('token', $token)->firstOrFail();

        $user->update(['token' => null]);

        return redirect('/log-in');
    }
    public function signIn(Request $request) {

        auth()->shouldUse('web');

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Nesprávné údaje'
                ] , 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Token could not be created'
            ], 500);
        }
        return response()->json([
            'token' => $token
        ],200);
    }
    public function getUserData(Request $request) {

        auth()->shouldUse('web');

        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
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
            'user' => $user
        ]);
    }
    public function forgotPassword(Request $request) {
        $user = User::where('email', $request->input('email'))->firstOrFail();

        $user->reset_password = str_random(25);
        $user->save();

        $user->notify(new ResetPassword($user));

        return response()->json([
            'message' => 'Email odeslán'
        ], 201);
    }
    public function resetPassword(Request $request) {
        $user = User::where('reset_password', $request->input('token'))->firstOrFail();

        $user->reset_password = null;
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json([
            'message' => 'Heslo změněno'
        ], 201);
    }
}
