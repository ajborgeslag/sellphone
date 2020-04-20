<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
            'imei' => 'required',
            'precio' => 'required|numeric',
            'fecha_venta' => 'required',
            /*'hora_venta'=>'required|date_format:H:i',*/
            'precio_dollar' => 'required|numeric',
            'vendedor' => 'required',
            'nombre'=> 'required',
            'metodo_pago'=>'required',
            'tipo_cliente'=>'required',
            'telefono'=>'numeric|nullable',
            'email'=>'email|nullable',


        ];
    }

    public function messages()
    {
        return [
            'imei.required' => 'El campo modelo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'precio.numeric' => 'El campo precio es numerico',
            'precio_dollar.required' => 'El campo precio del dollar es obligatorio',
            'precio_dollar.numeric' => 'El campo precio del dollar es numerico',
            'fecha_venta.required' => 'El campo fecha de venta es obligatorio',
            'vendedor.required' => 'El campo vendedor es obligatorio',
            'metodo_pago.required' => 'El campo metodo de pago es obligatorio',
            'nombre.required' => 'El campo nombre es obligatorio',
            'tipo_cliente.required' => 'El campo tipo cliente es obligatorio',
            'telefono.numeric'=>'El campo telefono solo acepta numeros',
            'email.email'=>'El formato de correo no es el correcto',
            'hora_venta.date_format'=>'Formato de la hora de venta incorrecto',
            'hora_venta.required'=>'El campo hora de venta es obligatorio',
        ];
    }
}
