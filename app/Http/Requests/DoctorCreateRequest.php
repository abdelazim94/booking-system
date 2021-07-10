<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorCreateRequest extends FormRequest
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
            'mobile' => 'required|unique:doctors,mobile|regex:/(01)[0-9]{9}/',
            'email' => 'required|email|unique:doctors,email,except,id',
            'slot' => 'required',
            'service_id' => 'required|exists:services,id'
        ];
    }
}
