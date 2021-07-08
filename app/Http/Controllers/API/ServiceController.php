<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use Validator;


class ServiceController extends BaseController
{
    public function index(){
        $services = Service::all();
        return $this->sendResponse(ServiceResource::collection($services), 'Services List.', 200);
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name_en' => 'required|min:3|max:150',
            'description_en' => 'required',
            'name_ar' => 'required|min:3|max:150',
            'description_ar' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors(), 422);       
        }
        $service = new Service;
        $service->setTranslations('name', [
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ]);
        $service->setTranslations('description', [
            'en' => $input['description_en'],
            'ar' => $input['description_ar']
        ]);
        $service->save();
        return $this->sendResponse(new ServiceResource($service), 'Service created.', 200);
    }

    public function show($id){
        $service = Service::find($id);
        if(! $service)
            return $this->sendError("Not Found", null,$code=404);
        return $this->sendResponse(new ServiceResource($service), 'Service Detail.', 200);
    }

    public function update(Request $request, $id){
        $service = Service::find($id);
        if(!$service){
            return sendError("Not Found", null,404);
        }
        $input = $request->all();
        $validator = Validator::make($input, [
            'name_en' => 'required|min:3|max:150',
            'description_en' => 'required',
            'name_ar' => 'required|min:3|max:150',
            'description_ar' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 422);       
        }

        $service->setTranslations('name', [
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ]);
        $service->setTranslations('description', [
            'en' => $input['description_en'],
            'ar' => $input['description_ar']
        ]);
        $service->save();
        return $this->sendResponse(new ServiceResource($service), 'Service updated.', 200);

    }

    public function destroy($id){
        $service = Service::find($id);
        if(!$service){
            return sendError("Not Found", 404);
        }
        return $this->sendResponse(null, 'Service Deleted.', 200);
    }
}

