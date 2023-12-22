<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "username"          => array("required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"),
            "password"          => array("required","min:8","max:16"),
            "password_repeat"   => array("same:password"),
            "apellidos"         => array("required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "nombres"           => array("required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "tipo_documento_id" => array("required","integer","min:1", "exists:tipos_documentos,id"),
            "documento_nro"     => array("required","unique:usuarios,documento_nro","min:1","max:99999999"),
            "genero_id"         => array("integer","min:1","exists:generos,id"),
            "cuil"              => array("nullable","numeric","digits:11"),
            "cuit"              => array("nullable","numeric","digits:11"),
            "fecha_nacimiento"  => array("required","date"),
            "telefono_fijo"     => array("nullable","numeric","max:999999999999999"),
            "telefono_celular"  => array("required","numeric","max:999999999999999"),
            "telefono_alt"      => array("nullable","numeric","max:999999999999999"),
            "email"             => array("required","unique:usuarios,email"),
        ];
    }
}
