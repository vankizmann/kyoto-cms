<?php

namespace Kyoto\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

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
            'state'            => 'required|integer',
            'name'             => 'required',
            'email'            => 'required|email',
            'password'         => 'required_new',
            'password_confirm' => 'required_with:password|same:password',
        ];
    }

}
