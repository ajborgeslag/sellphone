<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosFormRequest extends FormRequest
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
            'nombre_usuario' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre_usuario.required' => 'El campo usuario es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'password.required' => 'El campo password es obligatorio',
            'role_id.required' => 'El campo rol es obligatorio',
            'email.email'=>'Formato de correo electronico incorrecto',
        ];
    }
}
