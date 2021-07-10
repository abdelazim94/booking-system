<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);
        $status=Password::sendResetLink(request()->only('email'));
        if($status == Password::RESET_LINK_SENT){
            return [
                'status' => $status
            ];
        }
        throw ValidationException::withMessages([
            'email' => [$status]
        ]);
        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }
        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}
