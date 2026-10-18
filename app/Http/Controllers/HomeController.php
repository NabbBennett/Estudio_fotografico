<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function galeria()
    {
        return view('galeria');
    }

    public function servicios()
    {
        return view('servicios');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function enviarContacto(Request $request)
    {
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email',
            'mensaje' => 'required|string|min:10',
        ]);

        // Aqui la DB (proximamente)

        return back()->with('success', '¡Mensaje enviado correctamente! Te contactaremos pronto.');
    }
}