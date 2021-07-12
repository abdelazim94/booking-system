<?php

namespace App\Http\Requests;

use App\Enums\DayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;


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
            'service_id' => 'required|exists:services,id',
            'photo'=> 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'slots.*.day' => 'required|in:1,2,3,4,5,6,7',
            'slots.*.start' => 'required|date_format:H:i',
            'slots.*.end' => 'required|date_format:H:i|after:slots.*.start',

            // 'day' => new EnumRule(DayEnum::class),
        ];
    }
}
