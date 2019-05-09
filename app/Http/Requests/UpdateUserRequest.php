<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $rules = User::$rules;

        $rules['user_name'] = ['required',Rule::unique('users')->ignore($this->user)];
        $rules['email'] = ['required',Rule::unique('users')->ignore($this->user)];
        $rules['password'] = [];
        return $rules;
    }
}
