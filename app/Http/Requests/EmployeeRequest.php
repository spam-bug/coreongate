<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => ['required', 'alpha_space'],
            'username' => ['required', 'alpha_dash', 'unique:employee,username'],
            'password' => ['required', 'min:8', 'string'],
            'password_confirmation' => ['same:password'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required',
            'name.alpha_space' => 'Name must be a letter',

            'username.required' => 'Username is required',
            'username.alpha_dash' => 'Username may only contain letters, numbers, dashes, and underscores',
            'username.unique' => 'Username already exist',

            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 letters',
            
            'password_confirmation.same' =>  'Password does not match'
        ];
    }
}
