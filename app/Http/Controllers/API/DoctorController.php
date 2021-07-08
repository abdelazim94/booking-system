<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Validator;

class DoctorController extends BaseController
{
    public function index(){
        $doctors = User::role('doctor')->get();
        return $this->sendResponse(UserResource::collection($doctors), 'Services List.', 200);
    }

    public function store(Request $request){
     
           
    }

    public function show($id){
        
    }

    public function update(Request $request, $id){
        

    }

    public function destroy($id){
        
    }
}
