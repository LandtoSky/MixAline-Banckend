<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::where('username', $username)->first();
        if(!$user)
            return response()->json([
                'success' => false,
                'message' => "Invalid Username!"
            ], 401);
        if(app('hash')->check($password, $user->password)) {
            $user->token = md5(microtime());
            $user->save();
            return response()->json([
                'success' => true,
                'result' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Password!'
            ], 401);
        }
    }
    public function register(Request $request) 
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        $user = new User([
            'username' => $request->input('username'),
            'password' => app('hash')->make($request->input('password')),
            'email' => $request->input('email'),
            'token' => md5(microtime())
        ]);
        $user->save();
        return response()->json([
            'success' => true,
            'result' => $user
        ], 201);
    }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'result' => $users
        ], 201);
    }
}