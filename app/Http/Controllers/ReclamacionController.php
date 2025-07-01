<?php

namespace App\Http\Controllers;

use App\Models\Reclamacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ReclamacionController extends Controller
{
    // Muestra la lista de reclamos con estadísticas
    public function index()
    {
        $reclamaciones = Reclamacion::recientes()
            ->paginate(10);
            
        $estadisticas = [
            'total' => Reclamacion::count(),
            'pendientes' => Reclamacion::where('estado', 'pendiente')->count(),
            'en_proceso' => Reclamacion::where('estado', 'en_proceso')->count(),
            'resueltas' => Reclamacion::where('estado', 'resuelto')->count(),
        ];

        // Retorna la vista con los datos
        return view('reclamaciones.index', compact('reclamaciones', 'estadisticas'));
    }

    // Solo muestra el formulario para crear un reclamo
    public function create()
    {
        return view('reclamaciones.create');
    }

    // Guarda el reclamo nuevo
    public function store(Request $request)
    {
        // Validando los datos, no te olvides de esto
        $validator = Validator::make($request->all(), [
            'tipo_documento' => 'required|in:dni,ce,pasaporte,ruc',
            'numero_documento' => 'required|string|max:20',
            'telefono' => 'required|string|max:15',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'direccion' => 'required|string',
            'fecha_compra' => 'nullable|date',
            'tipo_reclamo' => 'required|in:reclamo,queja',
            'producto' => 'required|string|max:100',
            'detalle_reclamo' => 'required|string',
            'pedido_cliente' => 'required|string',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El email debe tener un formato válido.',
            'in' => 'El valor seleccionado para :attribute no es válido.',
        ]);

        // Si algo está mal, te lo digo en JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Guardando el reclamo en la base de datos
            $reclamacion = Reclamacion::create($request->all());
                
            // Mandando correo de confirmación (sí, automático)
            Mail::to($reclamacion->email)->send(new \App\Mail\ReclamacionRecibida($reclamacion));
                
            return response()->json([
                'success' => true,
                'message' => 'Reclamo registrado exitosamente. Te contactaremos en un plazo máximo de 15 días hábiles.',
                'data' => $reclamacion
            ]);
        } catch (\Exception $e) {
            // Algo salió mal, avísale al usuario
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el reclamo. Por favor, intenta nuevamente.'
            ], 500);
        }

    }

    // Muestra un reclamo específico
    public function show(Reclamacion $reclamacion)
    {
        return view('reclamaciones.show', compact('reclamacion'));
    }

    // Actualiza el estado del reclamo (por ejemplo: pendiente, resuelto, etc)
    public function updateEstado(Request $request, Reclamacion $reclamacion)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,resuelto,cerrado',
            'respuesta_empresa' => 'nullable|string'
        ]);

        // Cambiando el estado y guardando la respuesta
        $reclamacion->update([
            'estado' => $request->estado,
            'respuesta_empresa' => $request->respuesta_empresa,
            'fecha_respuesta' => now()
        ]);

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }

    // Elimina un reclamo (ojo, esto no se puede deshacer)
    public function destroy(Reclamacion $reclamacion)
    {
        try {
            $reclamacion->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Reclamo eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el reclamo.'
            ], 500);
        }
    }

    // Busca reclamos según filtros (bien útil)
    public function buscar(Request $request)
    {
        $query = Reclamacion::query();

        // Filtros varios, para que encuentres lo que buscas
        if ($request->filled('numero_documento')) {
            $query->where('numero_documento', 'like', '%' . $request->numero_documento . '%');
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_reclamo')) {
            $query->where('tipo_reclamo', $request->tipo_reclamo);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        $reclamaciones = $query->recientes()->paginate(10);

        // Retorna la vista con los resultados filtrados
        return view('reclamaciones.index', compact('reclamaciones'));
    }
}