<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReclamacionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo_documento' => 'required|in:dni,ce,pasaporte,ruc',
            'numero_documento' => 'required|string|max:20',
            'telefono' => 'required|string|max:15',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'direccion' => 'required|string',
            'fecha_compra' => 'nullable|date|before_or_equal:today',
            'tipo_reclamo' => 'required|in:reclamo,queja',
            'producto' => 'required|string|max:100',
            'detalle_reclamo' => 'required|string|min:10',
            'pedido_cliente' => 'required|string|min:10',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El email debe tener un formato válido.',
            'in' => 'El valor seleccionado no es válido.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'before_or_equal' => 'La fecha de compra no puede ser posterior a hoy.',
        ];
    }

    public function attributes()
    {
        return [
            'tipo_documento' => 'tipo de documento',
            'numero_documento' => 'número de documento',
            'telefono' => 'teléfono',
            'nombres' => 'nombres',
            'apellidos' => 'apellidos',
            'email' => 'correo electrónico',
            'direccion' => 'dirección',
            'fecha_compra' => 'fecha de compra',
            'tipo_reclamo' => 'tipo de reclamo',
            'producto' => 'producto',
            'detalle_reclamo' => 'detalle del reclamo',
            'pedido_cliente' => 'pedido del cliente',
        ];
    }
}