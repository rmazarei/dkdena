<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentAuthRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Comment;
use App\Models\CustomUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $user = null;
        $message = '';
        $token = null;
        $responseCode = 200;

        $user = CustomUser::firstWhere('mobile', $request->mobile);


        if($user){
            $checkUser = Hash::check($request->password, $user->password);
            if($checkUser){
                $message = 'Welcome to the soldier side';
                $token = $user->createToken('RoohToken')->plainTextToken;
                $user->api_token = $token;
                $user->save();
            } else {
                $message = '(Could not) Breaking through to the other side';
                $responseCode = 401;
            }
        }
        return response()->json([
            'data' => [
                'message'    => $message,
                'token'    => $token,
            ],
            'server_time'   => Carbon::now(),
        ], $responseCode);

    }

    public function store(CommentRequest $request)
    {
        $user = $request->user();
        $comment = new Comment();
        $comment->user_id     = $user->id;
        $comment->title     = $request->title;
        $comment->body     = $request->body;
        $comment->save();

        return response()->json([
            'data' => [
                'message'    => 'نظر شما با موفقیت ذخیره شد',
            ],
            'server_time'   => Carbon::now(),
        ]);
    }
}
