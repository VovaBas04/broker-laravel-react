<?php

namespace App\Http\Responses;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $token = $request->user()->createToken("Authorization");
        return new JsonResponse(['token'=>$token->plainTextToken]);
    }
}
