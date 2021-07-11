<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Resources\DoctorCollection;
use App\Http\Resources\DoctorResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Http\Services\ImageUploader;
use App\Models\Doctor;
use App\Models\Service;
use Validator;

class DoctorController extends BaseController
{

    private $imageUploader;
    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }
    public function index(){
        $doctors = Doctor::paginate(5);
        return $this->sendResponse(new DoctorCollection($doctors), __('lang.Services List'), Response::HTTP_OK);
    }

    public function store(DoctorCreateRequest $request){
        $formData = $request->all();
        if($request->has('photo')){
            $photo = $this->imageUploader->upload($request->photo, 'doctors/photos', $size=[150,150]);
            $formData['photo'] = $photo;
        }
        $doctor= Doctor::create($formData);

        // fire observer reset password
        return $this->sendResponse(new DoctorResource($doctor), __('lang.created'), $status=Response::HTTP_CREATED);
    }

    public function show(Doctor $doctor){
        return $this->sendResponse(new DoctorResource($doctor), __('lang.detail'), $status=Response::HTTP_OK);
    }

    public function update(DoctorCreateRequest $request,Doctor $doctor){
        $formData = $request->all();
        if($request->has('photo')){
            $photo = $this->imageUploader->upload($request->photo, 'doctors/photos', $size=[150,150]);
            $formData['photo'] = $photo;
        }
        $doctor = $doctor->update($formData);

        return $this->sendResponse(new DoctorResource($doctor), __('lang.updated'), $status=Response::HTTP_OK);
    }

    public function destroy(Doctor $doctor){
        $doctor->delete();
        return $this->sendResponse($sata= null, __('lang.Deleted'), $status=Response::HTTP_OK);
    }
}
