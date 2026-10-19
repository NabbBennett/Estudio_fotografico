<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitaController extends Controller
{
    // Mostrar formulario de agendar cita
    public function create()
    {
        return view('citas.create');
    }

    // Guardar la cita en la BD
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email',
            'telefono' => ['required', 'digits:10'],
            'servicio' => 'required|in:fiesta infantil,graduacion,boda,retrato',
            'fecha'    => 'required|date|after_or_equal:today',
            'hora'     => 'required',
            'mensaje'  => 'nullable|string',
        ]);

        Cita::create([
            'user_id'  => auth()->id(), // Si está logueado, se asocia; si no, queda null
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'servicio' => $request->servicio,
            'fecha'    => $request->fecha,
            'hora'     => $request->hora,
            'mensaje'  => $request->mensaje,
            'estado'   => 'pendiente',
        ]);

        return redirect()->route('usuario.panel')->with('success', '¡Cita agendada! Te contactaremos para confirmar.');
    }
}