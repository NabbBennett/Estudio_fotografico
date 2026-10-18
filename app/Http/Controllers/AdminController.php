<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard principal del admin
    public function index()
    {
        $totalCitas      = Cita::count();
        $citasPendientes = Cita::where('estado', 'pendiente')->count();
        $totalUsuarios   = User::where('role', 'user')->count();

        return view('admin.panel', compact('totalCitas', 'citasPendientes', 'totalUsuarios'));
    }

    // Listar todas las citas
    public function citas(Request $request)
    {
        $busqueda = trim((string) $request->query('buscar', ''));

        $citas = Cita::when($busqueda !== '', function ($query) use ($busqueda) {
            $query->where(function ($query) use ($busqueda) {
                $query->where('nombre', 'like', "%{$busqueda}%")
                    ->orWhere('email', 'like', "%{$busqueda}%")
                    ->orWhere('telefono', 'like', "%{$busqueda}%");
            });
        })
        ->orderBy('fecha', 'desc')
        ->get();

        return view('admin.citas', compact('citas', 'busqueda'));
    }

    // Actualizar estado de una cita (confirmar, cancelar, completar)
    public function actualizarCita(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada,completada',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update(['estado' => $request->estado]);

        return back()->with('success', 'Estado de la cita actualizado.');
    }

    // Eliminar una cita
    public function eliminarCita($id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->productos_path) {
            Storage::disk('local')->delete($cita->productos_path);
        }

        $cita->delete();
        return back()->with('success', 'Cita eliminada correctamente.');
    }

    public function subirProductos(Request $request, Cita $cita)
    {
        if ($cita->estado !== 'completada') {
            return back()->withErrors([
                'productos' => 'Solo puedes adjuntar fotos cuando la cita está completada.',
            ]);
        }

        $validated = $request->validate([
            'productos' => 'required|file|mimes:zip|max:51200',
        ], [
            'productos.required' => 'Selecciona un archivo ZIP.',
            'productos.mimes' => 'El archivo debe estar en formato ZIP.',
            'productos.max' => 'El archivo no puede superar los 50 MB.',
        ]);

        if ($cita->productos_path) {
            Storage::disk('local')->delete($cita->productos_path);
        }

        $archivo = $validated['productos'];
        $ruta = $archivo->store('productos', 'local');

        $cita->update([
            'productos_path' => $ruta,
            'productos_nombre' => $archivo->getClientOriginalName(),
            'productos_subidos_at' => now(),
        ]);

        return back()->with('success', 'Productos entregados correctamente al cliente.');
    }

    // Listar todos los usuarios
    public function usuarios()
    {
        $usuarios = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.usuarios', compact('usuarios'));
    }
}