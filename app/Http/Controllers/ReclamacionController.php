<?php

namespace App\Http\Controllers;

use App\Models\Reclamacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ReclamacionController extends Controller
{
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

        return view('reclamaciones.index', compact('reclamaciones', 'estadisticas'));
    }

    public function create()
    {
        return view('reclamaciones.create');
    }

    public function store(Request $request)
    {
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $reclamacion = Reclamacion::create($request->all());
                

            Mail::to($reclamacion->email)->send(new \App\Mail\ReclamacionRecibida($reclamacion));
                
            return response()->json([
                'success' => true,
                'message' => 'Reclamo registrado exitosamente. Te contactaremos en un plazo máximo de 15 días hábiles.',
                'data' => $reclamacion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el reclamo. Por favor, intenta nuevamente.'
            ], 500);
        }

    }

    public function show(Reclamacion $reclamacion)
    {
        return view('reclamaciones.show', compact('reclamacion'));
    }

    public function updateEstado(Request $request, Reclamacion $reclamacion)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,resuelto,cerrado',
            'respuesta_empresa' => 'nullable|string'
        ]);

        $reclamacion->update([
            'estado' => $request->estado,
            'respuesta_empresa' => $request->respuesta_empresa,
            'fecha_respuesta' => now()
        ]);

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }

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

    public function buscar(Request $request)
    {
        $query = Reclamacion::query();

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

        return view('reclamaciones.index', compact('reclamaciones'));
    }
}