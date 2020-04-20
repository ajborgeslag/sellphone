<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CotizacionFormRequest extends FormRequest
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
            'valor' => 'required|numeric',
            'fecha' => 'required',
            /*'hora'=>'required|date_format:H:i',*/
        ];
    }

    public function messages()
    {
        return [
            'valor.required' => 'El campo valor es obligatorio',
            'fecha.required' => 'El campo fecha es obligatorio',
            'valor.numeric' => 'El campo valor debe ser numerico',
            /*'hora.date_format'=>'Formato de la hora es incorrecto',
            'hora.required'=>'El campo hora es obligatorio',*/
        ];
    }
}
