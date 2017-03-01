<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CourseRequest extends FormRequest
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
            'image'=>'sometimes | image',
            'course_name'=>'required',
            'course_code'=>'required | min:6',
            'credits'=>'required'

        ];
    }
}
