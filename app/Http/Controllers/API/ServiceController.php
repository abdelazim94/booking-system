<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceCollection;
use App\Models\Service;
use Illuminate\Http\Response;
use App\Http\Resources\ServiceResource;
use App\Repository\Eloquent\ServiceRepository;

class ServiceController extends BaseController
{

    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->paginate();
        return $this->sendResponse(new ServiceCollection($services), __('lang.msg'), Response::HTTP_OK);
    }

    public function store(ServiceRequest $request)
    {
        $inputs = $request->validated();
        $service = new Service;
        $service->setFieldsTranslations([
            'name' => [
                'en' => $inputs['name_en'],
                'ar' => $inputs['name_ar']
            ],
            'description' => [
                'en' => $inputs['description_en'],
                'ar' => $inputs['description_ar']
            ]
        ]);

        return $this->sendResponse(new ServiceResource($service), __('lang.Service created'), Response::HTTP_CREATED);
    }

    public function show(Service $service)
    {
        return $this->sendResponse(new ServiceResource($service), 'Service Detail.', Response::HTTP_OK);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $inputs = $request->validated();
        $service->setFieldsTranslations([
            'name' => [
                'en' => $inputs['name_en'],
                'ar' => $inputs['name_ar']
            ],
            'description' => [
                'en' => $inputs['description_en'],
                'ar' => $inputs['description_ar']
            ]
        ]);
        return $this->sendResponse(new ServiceResource($service), __('lang.Service updated'), Response::HTTP_OK);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return $this->sendResponse(null, __('lang.Service Deleted'), Response::HTTP_NO_CONTENT);
    }
}
