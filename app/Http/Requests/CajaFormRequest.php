<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaFormRequest extends FormRequest
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
            'saldo_pesos' => 'numeric',
            'saldo_dollar' => 'numeric',
            'observacion' => 'required',
            'saldo_final' => 'required',
            'concepto'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'saldo_pesos.numeric' => 'El campo pesos es numerico',
            'saldo_dollar.numeric' => 'El campo dolar es numerico',
            'observacion.required' => 'El campo observacion es obligatorio',
            'concepto.required'=> 'El campo concepto es obligatorio',
            'saldo_final.required'=> 'Debe poner pesos o dolar',
        ];
    }
}
