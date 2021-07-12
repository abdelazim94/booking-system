<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Http\Resources\DoctorCollection;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Response;
use App\Http\Services\ImageUploader;
use App\Models\Doctor;
use App\Repository\Eloquent\DoctorRepository;

class DoctorController extends BaseController
{
    private $imageUploader;
    private $doctorRepository;

    public function __construct(ImageUploader $imageUploader, DoctorRepository $doctorRepository)
    {
        $this->imageUploader = $imageUploader;
        $this->doctorRepository = $doctorRepository;
    }

    public function index()
    {
        $doctors = $this->doctorRepository->paginate(5, ['service', 'slots']);
        return $this->sendResponse(new DoctorCollection($doctors), __('lang.Services List'), Response::HTTP_OK);
    }

    public function store(DoctorCreateRequest $request)
    {
        $formData = $request->validated();
        if($request->has('photo'))
        {
            $photo = $this->imageUploader->upload($request->photo, 'doctors/photos', $size=[150,150]);
            $formData['photo'] = $photo;
        }
        $doctor = $this->doctorRepository->create($formData);
        // fire observer reset password
        $slots= $request->only('slots');
        $slots=reset($slots);
        $doctor->createManySlots($slots);

        return $this->sendResponse(new DoctorResource($doctor), __('lang.created'), $status=Response::HTTP_CREATED);
    }

    public function show(Doctor $doctor)
    {
        return $this->sendResponse(new DoctorResource($doctor), __('lang.detail'), $status=Response::HTTP_OK);
    }

    public function update(DoctorUpdateRequest $request,Doctor $doctor)
    {
        $formData = $request->validated();
        if($request->has('photo'))
        {
            $photo = $this->imageUploader->upload($request->photo, 'doctors/photos', $size=[150,150]);
            $formData['photo'] = $photo;
        }
        $this->doctorRepository->updateWitBind($doctor, $formData);
        return $this->sendResponse(new DoctorResource($doctor->fresh()), __('lang.updated'), $status=Response::HTTP_OK);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return $this->sendResponse($sata= null, __('lang.Deleted'), $status=Response::HTTP_OK);
    }
}
