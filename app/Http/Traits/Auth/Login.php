<?php
namespace App\Http\Traits\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


trait Login
{
    public function loginWithGuard($guard, array $cradential){
        if(Auth::guard($guard)->attempt($cradential)){
            $user = Auth::guard($guard)->user();
            $data['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
            $data['user'] =  $user;
            return $this->sendResponse($data, __('lang.User signed in'),Response::HTTP_OK);
        }
        else{
            return $this->sendError(['error'=>__('lang.Cradential error')], Response::HTTP_UNAUTHORIZED);
        }
    }
}
