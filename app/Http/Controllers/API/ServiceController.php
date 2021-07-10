<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceCollection;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ServiceResource;


class ServiceController extends BaseController
{
    public function index()
    {
        $services = Service::paginate(5);
        return $this->sendResponse(new ServiceCollection($services), __('lang.msg'), Response::HTTP_OK);
    }

    public function store(ServiceRequest $request)
    {
        $inputs = $request->all();
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
        $inputs = $request->all();
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
        return $this->sendResponse(null, __('lang.Service Deleted'), Response::HTTP_NO_CONTENT);
    }
}
