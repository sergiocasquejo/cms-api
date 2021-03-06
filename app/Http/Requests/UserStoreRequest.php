<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
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
            'username' => 'required|unique:users|between:6,60',
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|between:min:6,60',
            'confirm_password' => 'required|between:min:6,60|same:password'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(['success' => false, 'data' => $validator->errors()], 422));
    }
}