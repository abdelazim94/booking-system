<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\DoctorCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Doctor;
use Validator;

class DoctorController extends BaseController
{
    public function index(){
        $doctors = Doctor::paginate(5);
        return $this->sendResponse(UserResource::collection($doctors), 'Services List.', 200);
    }

    public function store(DoctorCreateRequest $request){
        $doctor= Doctor::create($request->all());
        

    }

    public function show($id){

    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

    }
}
