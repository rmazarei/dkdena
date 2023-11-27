<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentAuthRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Comment;
use App\Models\CustomUser;
use App\Traits\CustomResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
    use CustomResponseTrait;

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
        return $this->customResponse([
                'message'    => $message,
                'token'    => $token,
        ], $responseCode);

    }

    public function store(CommentRequest $request): JsonResponse
    {
        $user = $request->user();
        $comment = new Comment();
        $comment->user_id     = $user->id;
        $comment->title     = $request->title;
        $comment->body     = $request->body;
        $comment->save();

        return $this->customResponse([
                'message'    => 'نظر شما با موفقیت ذخیره شد',
            ]);
    }
}
