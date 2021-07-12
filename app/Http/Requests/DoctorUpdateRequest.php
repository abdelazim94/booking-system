<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|min:5',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:doctors,mobile,'.request()->segment(5).'except,id',
            'email' => 'required|email|unique:doctors,email,'.request()->segment(5).',id',
            'slot' => 'integer|max:30|min:10',
            'service_id' => 'exists:services,id',
            'photo'=> 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'slots.*.day' => 'required|in:1,2,3,4,5,6,7',
            'slots.*.start' => 'required|date_format:H:i',
            'slots.*.end' => 'required|date_format:H:i|after:slots.*.start',
        ];
    }
}
