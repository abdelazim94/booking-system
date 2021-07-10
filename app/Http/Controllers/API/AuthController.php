<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\DoctorLoginRequest;
use App\Http\Requests\Auth\PatientLoginRequest;
use App\Http\Requests\Auth\PatientSignupRequest;
use App\Models\Patient;
use App\Http\Traits\Auth\Login as LoginTrait;

class AuthController extends BaseController
{
    use  LoginTrait;

    public function patientLogin(PatientLoginRequest $request)
    {
        return $this->loginWithGuard('patients', ['mobile'=>$request->input('mobile'), 'password'=>$request->input('password')]);
    }
    public function adminLogin(AdminLoginRequest $request)
    {
        return $this->loginWithGuard('admins', ['username'=>$request->input('username'), 'password'=>$request->input('password')]);
    }

    public function doctorLogin(DoctorLoginRequest $request)
    {
        return $this->loginWithGuard('doctors', ['mobile'=>$request->input('mobile'), 'password'=>$request->input('password')]);

    }

    public function signup(PatientSignupRequest $request)
    {
        $user = Patient::create($request->all());
        $data['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $data['user'] =  $user;
        return $this->sendResponse($data, __('lang.user created successfully'), Response::HTTP_CREATED);
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse(null, __('lang.log out'), $status=Response::HTTP_OK);
    }

}
