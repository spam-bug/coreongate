<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'first_name' => ['required', 'alpha_space'],
                    'last_name' => ['required', 'alpha_space'],
                    'username' => ['required', 'alpha_dash', 'min:6', 'unique:client,username'],
                    'email' => ['required', 'email', 'unique:client,email'],
                    'password' => ['required', 'string', 'min:8'],
                    'password_confirmation' => ['same:password'],
                    'address' => ['required', 'string'],
                    'contact_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11'],
                    'birthday' => ['required', 'date_format:Y-m-d', 'before:today'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $client = Client::findOrFail(request()->segment(2));
                
                return [
                    'first_name' => ['required', 'alpha_space'],
                    'last_name' => ['required', 'alpha_space'],
                    'username' => ['required', 'alpha_dash', 'min:6', 'unique:client,username,' . $client->id],
                    'email' => ['required', 'email', 'unique:client,email,' . $client->id],
                    'password' => ['nullable', 'min:8'],
                    'password_confirmation' => ['same:password'],
                    'address' => ['required', 'string'],
                    'contact_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11'],
                    'birthday' => ['required', 'date_format:Y-m-d', 'before:today'],
                ];
            }
            default: break;
        }


        
    }

    public function messages() {
        return [
            'first_name.alpha_space' => 'First name may only contain letters.',
            'first_name.required' => 'First name is required.',

            'last_name.alpha_space' => 'Last name may only contain letters.',
            'last_name.required' => 'Last name is required.',

            'username.required' => 'Username is required.',
            'username.alpha_dash' => 'Username may only contain letters, underscores and dashes.',
            'username.min' => 'Username must be at least 6 letters.',
            'username.unique' => 'Username already exists.',

            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email already exists.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 letters',

            'password_confirmation.same' => 'Password does not match',

            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a valid address.',

            'contact_number.required' => 'Contact number is required.',
            'contact.min' => 'Contact number must be a valid number.',
            'contact.regex' => 'Contact number must be a valid number.',

            'birthday.required' => 'Birthday is required.',
            'birthday.date_format' => 'Birthday must be a valid date format.',
            'birthday.before' => 'Birthday must be a valid birthday.'
        ];
    }
}
