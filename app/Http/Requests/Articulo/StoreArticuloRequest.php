<?php

namespace App\Http\Requests\Articulo;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticuloRequest extends FormRequest
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
            'codigo'        => array('required','string','max:12'),
            'nombre'        => array('required','string','max:100'),
            'descripcion'   => array('required','string','max:255'),
            'precio'        => array('required','decimal:9,2'),
            'moneda'        => array('required','integer'),
            'categoria'     => array('required','integer'),
            'subcategoria'  => array('required','integer'), 
            'foto1'         => array('nullable','string','max:50'),
            'foto2'         => array('nullable','string','max:50'),
            'foto3'         => array('nullable','string','max:50'),
            'foto4'         => array('nullable','string','max:50'),
            'foto5'         => array('nullable','string','max:50'),
            'foto6'         => array('nullable','string','max:50'),
            'foto7'         => array('nullable','string','max:50'),
            'foto8'         => array('nullable','string','max:50'),
            'activo'        => array('nullable'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "required" => "Este campo es obligatorio",
        ];
    }
}
