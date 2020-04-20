<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeloFormRequest extends FormRequest
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
            'desc' => 'required',
            'marca_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'desc.required' => 'El campo modelo es obligatorio',
            'marca_id.required' => 'El campo marca es obligatorio'
        ];
    }
}
