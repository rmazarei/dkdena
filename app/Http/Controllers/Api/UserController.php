<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $message = '';
        $token = null;
        $responseCode = 200;
        $checkUser = Auth::attempt(['mobile'=>$request->mobile, 'password'=>$request->password]);

        if($checkUser){
            $message = 'Welcome to the soldier side';
            $token = Auth::user()->createToken('RoohToken')->plainTextToken;
        } else {
            $message = '(Could not) Breaking through to the other side';
            $responseCode = 401;
        }

        return response()->json([
            'data'  => [
                'message'    => $message,
                'token'    => $token,
            ],
            'server_time'   => date(now()),
        ], $responseCode);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'data'  => [
                'message'    => 'Goodbye blue sky',
            ],
            'server_time'   => date(now()),
        ]);
    }
}
