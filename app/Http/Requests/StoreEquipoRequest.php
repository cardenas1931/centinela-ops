<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Por ahora true; cuando agreguemos roles (siguiente paso), aquí
        // verificaremos que el usuario autenticado sea admin.
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'tipo' => ['nullable', 'string', 'max:255'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'umbral_alerta_segundos' => ['nullable', 'integer', 'min:10', 'max:3600'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del equipo es obligatorio.',
            'umbral_alerta_segundos.min' => 'El umbral debe ser de al menos 10 segundos.',
        ];
    }
}