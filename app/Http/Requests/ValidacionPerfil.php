<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class ValidacionPerfil extends FormRequest
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
            'usuario' => 'unique:usuarios,usuario,'. Session::get('usuario')->id,
            'email' => 'unique:usuarios,email,'. Session::get('usuario')->id,
        ];
    }

    public function messages()
    {
        return [
            'usuario.unique' => 'El usuario ya existe',
            'email.unique' => 'El email ya existe'
        ];
    }
}
