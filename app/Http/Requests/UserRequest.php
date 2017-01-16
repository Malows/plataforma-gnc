<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Si no cambio a true, nunca me deja, aunque sea admin me tira forbidden
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $reglas = [
            'name' => 'min:4|max:255|required',
            'tipo_usuario_id' => 'exists:tipos_usuarios,id|required',
            'habilitado' => 'boolean|required',
        ];
        switch($this->method())
        {
            case 'POST':
            {
                $reglas['password'] = 'min:8|required|confirmed';
                $reglas['email'] = 'email|max:255|required|unique:users';
                $reglas['duracion_de_licencia'] = 'in:30,365|required';
                return $reglas;
            }
            case 'PUT':
            case 'PATCH':
            {
                $reglas['email'] = 'email|max:255|required|' . $this->uniqueEmail();
                $reglas['agregar_licencia'] = 'in:0,30,365|present';
                return $reglas;
            }
            default:
            {
                return [];
            }
        }
    }

    //checks if the property exists or not
    public function uniqueEmail() {

        $id = $this->input('id');
        $email = $this->input('email');

        if( Auth::user()->tipo_usuario_id === 1 or
            User::where(compact('id', 'email'))->exists() ){
            return "unique:users,email,$id";
        }
        return 'unique:users';
    }
}
