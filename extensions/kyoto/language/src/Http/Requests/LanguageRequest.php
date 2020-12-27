<?php

namespace Kyoto\Language\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest {

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
            'state'         => 'required|integer',
            'hide'          => 'required|integer',
            'language'      => 'required',
            'country'       => 'required',
            'locale'        => 'required|size:2|unique_val:languages',
            'plate'         => 'required|size:2|unique_val:languages',
        ];
    }

}
