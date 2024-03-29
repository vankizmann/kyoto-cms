<?php

namespace Liro\Web\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuMoveRequest extends FormRequest
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
            'state'         => 'required|integer',
            'hide'          => 'required|integer',
            'type'          => 'required',
            'title'         => 'required|min:3',
            'slug'          => 'required',
        ];
    }

}
