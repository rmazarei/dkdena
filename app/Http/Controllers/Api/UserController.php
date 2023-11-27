<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\CustomResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use CustomResponseTrait;
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

        return $this->customResponse([
                'message'    => $message,
                'token'    => $token,
            ], $responseCode);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return $this->customResponse([
                'message'    => 'Goodbye blue sky',
            ]);
    }
}
