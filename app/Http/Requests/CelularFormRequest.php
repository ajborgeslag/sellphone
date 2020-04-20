<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CelularFormRequest extends FormRequest
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
            'modelo_id' => 'required',
            'marca_id' => 'required',
            'color_id' => 'required',
            'capacidad_id' => 'required',
            'proveedor' => 'required',
            'fecha_compra' => 'required',
            'precio_compra'=>'required|numeric'


        ];
    }

    public function messages()
    {
        return [
            'modelo_id.required' => 'El campo modelo es obligatorio',
            'marca_id.required' => 'El campo marca es obligatorio',
            'color_id.required' => 'El campo color es obligatorio',
            'capacidad_id.required' => 'El campo capacidad es obligatorio',
            'proveedor.required' => 'El campo proveedor es obligatorio',
            'fecha_compra.required' => 'El campo fecha compra es obligatorio',
            'precio_compra.required' => 'El campo precio compra es obligatorio',
            'precio_compra.numeric' => 'El campo precio compra solo admite numeros',

        ];
    }
}
