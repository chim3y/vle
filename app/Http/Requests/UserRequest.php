<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
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
         'name'=>'required | unique',
         'email'=>'required | min:6 | unique | ',
         'password'=> 'required|min:6 | regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', 
         
        ];
    }
    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }
}
