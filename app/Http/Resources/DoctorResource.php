<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'service' => new ServiceResource($this->service),
            'slots' => SlotResource::collection($this->slots)
        ];
    }
}
