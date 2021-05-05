<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Plan;

class PlanRequest extends FormRequest
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
                    'name' => ['required', 'string', 'unique:plans,name'],
                    'description' => ['required'],
                    'hours' => ['required_without:minutes', 'numeric'],
                    'minutes' => ['required_without:hours', 'numeric'],
                    'unlimited_time' => ['required_without_all:hours,minutes'],
                    'expiration' => ['required', 'numeric'],
                    'no_expiration' => ['required_without:expiration'],

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $plan = Plan::findOrFail(request()->segment(4));


                return [
                    'name' => ['required', 'string', 'unique:plans,name,' . $plan->id],
                    'description' => ['required'],
                    'hours' => ['required_without:minutes', 'numeric'],
                    'minutes' => ['required_without:hours', 'numeric'],
                    'unlimited_time' => ['required_without_all:hours,minutes'],
                    'expiration' => ['required', 'numeric'],
                    'no_expiration' => ['required_without:expiration'],
                ];
            }
            default: break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Plan name is required!',
            'name.unique' => 'Plan name must be unique.',
            'description.required' => 'Plan description is required!',
            'hours.required_without' => 'Hour or Minute must be present.',
            'hours.numeric' => 'Hour must be a number.',
            'minutes.required_without' => 'Hour or Minute must be present.',
            'minutes.numeric' => 'Minute must be a number.',
            'unlimited_time.required_without' => 'Unlimited time cannot have hour or minute.',
            'expiration.required' => 'Expiration is required!',
            'expiration.numeric' => 'Expiration must be a number.',
            'no_expiration' =>  'No expiration cannot have a day/s',
        ];
    }

}
