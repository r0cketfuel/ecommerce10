<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Genero;
use App\Models\TipoDocumento;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $generos        = Genero::count();
        $tiposDocumento = TipoDocumento::count();

        return [
            "username"          => array("required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"),
            "password"          => array("required","min:8","max:16"),
            "password_repeat"   => array("same:password"),
            "apellidos"         => array("required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "nombres"           => array("required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "tipo_documento_id" => array("required","integer","min:1","max:" . $tiposDocumento),
            "documento_nro"     => array("required","unique:usuarios,documento_nro","min:1","max:8"),
            "genero_id"         => array("integer","min:1","max:" . $generos),
            "cuil"              => array("nullable","digits:11","regex:#^[0-9]*$#"),
            "cuit"              => array("nullable","digits:11","regex:#^[0-9]*$#"),
            "fecha_nacimiento"  => array("required","date"),
            "domicilio"         => array("required","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "domicilio_nro"     => array("required","max:5","regex:#^[0-9]*$#"),
            "domicilio_piso"    => array("nullable","max:2","regex:#^[a-zA-Z0-9]*$#"),
            "domicilio_depto"   => array("nullable","max:2","regex:#^[a-zA-Z0-9]*$#"),
            "localidad"         => array("required","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
            "codigo_postal"     => array("required","max:10","regex:#^[a-zA-Z0-9]*$#"),
            "telefono_fijo"     => array("nullable","max:15","regex:#^[0-9]*$#"),
            "telefono_celular"  => array("required","max:15","regex:#^[0-9]*$#"),
            "telefono_alt"      => array("nullable","max:15","regex:#^[0-9]*$#"),
            "email"             => array("required","unique:usuarios,email"),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "username.min"          => "El nombre de usuario debe tener entre 8 y 16 caracteres",
            "username.max"          => "El nombre de usuario debe tener entre 8 y 16 caracteres",
            "username.unique"       => "Ya existe un usuario registrado con ese nombre",

            "password.min"          => "La contraseña debe tener entre 8 y 16 caracteres",
            "password.max"          => "La contraseña debe tener entre 8 y 16 caracteres",
            "password_repeat.min"   => "La contraseña debe tener entre 8 y 16 caracteres",
            "password_repeat.max"   => "La contraseña debe tener entre 8 y 16 caracteres",

            "unique"                => "Ya existe un usuario registrado con la información proporcionada",
            "regex"                 => "Caracteres no permitidos",
            "min"                   => "Longitud mínima requerida",
            "max"                   => "Longitud máxima requerida",
            "required"              => "Este campo es obligatorio",
            "same"                  => "Las contraseñas no coinciden",
            "digits"                => "Error en la longitud de la información ingresada"
        ];
    }
}
