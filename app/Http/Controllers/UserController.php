<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Mostrar panel del usuario
    public function index()
    {
        // Traer solo las citas del usuario logueado
        $citas = Cita::where('user_id', Auth::id())
                     ->orderBy('fecha', 'asc')
                     ->get();

        $productos = Cita::where('user_id', Auth::id())
                         ->whereNotNull('productos_path')
                         ->orderByDesc('productos_subidos_at')
                         ->get();

        return view('usuario.panel', compact('citas', 'productos'));
    }

    // Cancelar una cita
    public function cancelarCita($id)
    {
        $cita = Cita::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $cita->update(['estado' => 'cancelada']);

        return back()->with('success', 'Cita cancelada correctamente.');
    }

    public function descargarProductos(Cita $cita)
    {
        abort_unless($cita->user_id === Auth::id() && $cita->productos_path, 404);
        abort_unless(Storage::disk('local')->exists($cita->productos_path), 404);

        return Storage::disk('local')->download(
            $cita->productos_path,
            $cita->productos_nombre ?: 'productos-cita-'.$cita->id.'.zip'
        );
    }
}