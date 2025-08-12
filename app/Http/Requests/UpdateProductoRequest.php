<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
    public function rules()
    {
        // Obtenemos el ID del producto actual para excluirlo de la validación de unicidad
        $productoId = $this->route('producto')->id;

        $rules = [
            'codigo' => 'required|string|max:80|unique:productos,codigo,' . $productoId,
            'nombre' => 'required|string|max:80',
            'descripcion' => 'nullable|string',
            'stock_minimo' => 'required|numeric|min:0',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'presentacione_id' => 'required|exists:presentaciones,id',
            'es_medicamento' => 'nullable|boolean',
        ];

        if ($this->input('es_medicamento')) {
            $rules = array_merge($rules, [
                'registro_invima' => 'required|string|max:80',
                'concentracion' => 'required|string|max:20',
                'forma_farmaceutica' => 'required|string|max:80',
                'principio_activo' => 'required|string',
                'denominacion' => 'required|string|max:20',
                'venta_sujeta' => 'required|string',
                'via_administracion' => 'required|string',
                'laboratorio_id' => 'required|exists:laboratorios,id',
                'tipos' => 'required|array|min:1',
                'tipos.*' => 'exists:tipos,id',
                'sintomas' => 'required|array|min:1',
                'sintomas.*' => 'exists:sintomas,id',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El código del producto es obligatorio.',
            'codigo.unique' => 'El código del producto ya está en uso.',
            // Otros mensajes personalizados si es necesario
        ];
    }
}