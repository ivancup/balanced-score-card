<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmpleadoRequest extends FormRequest
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
        $id = $this->route()->parameter('empleado');

        return [
            'nombre' => 'string',
            'apellido' => 'string',
            'telefono' => 'digits_between:8,11|'.Rule::unique('empleados')->ignore($id),
            'email' => 'email|'.Rule::unique('empleados')->ignore($id),
            'area' => 'exists:areas,id'
        ];
    }
}
