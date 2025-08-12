<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePresentacioneRequest extends FormRequest
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
        $presentacione = $this->route('presentacione');  // Asegúrate de que el nombre de la ruta coincida
    
        if ($presentacione && $presentacione->caracteristica) {
            $caracteristicaId = $presentacione->caracteristica->id;
        } else {
            $caracteristicaId = null;  // O lanzar una excepción si es necesario
        }
    
        return [
            'nombre' => 'required|max:60|unique:caracteristicas,nombre,' . $caracteristicaId,
            'descripcion' => 'nullable|max:255'
        ];
    }
}
