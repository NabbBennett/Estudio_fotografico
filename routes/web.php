<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Cualquiera puede entrar)
|--------------------------------------------------------------------------
*/

// Página 1: Inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Página 2: Galería
Route::get('/galeria', [HomeController::class, 'galeria'])->name('galeria');

// Página 3: Servicios
Route::get('/servicios', [HomeController::class, 'servicios'])->name('servicios');

// Página 4: Contacto
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [HomeController::class, 'enviarContacto'])->name('contacto.enviar');

// Página 5: Agendar Cita (Formulario público)
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación (Invitados)
|--------------------------------------------------------------------------
| Estas rutas solo son accesibles si NO has iniciado sesión.
| Si ya estás logueado, te redirigen al panel correspondiente.
*/

Route::middleware('guest')->group(function () {
    // Página 6: Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Página 7: Registro
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Solo usuarios logueados)
|--------------------------------------------------------------------------
| El middleware 'auth' verifica que haya una sesión activa.
*/

Route::middleware('auth')->group(function () {
    
    // Cerrar Sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Página 8: Panel de Usuario (Cliente)
    // Solo accesible para usuarios con rol 'cliente' o 'user'
    Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
        Route::get('/usuario/panel', [UserController::class, 'index'])->name('usuario.panel');
        Route::delete('/citas/{id}', [UserController::class, 'cancelarCita'])->name('citas.cancelar');
        Route::get('/citas/{cita}/productos', [UserController::class, 'descargarProductos'])->name('usuario.descargarProductos');
    });

    // Página 9: Panel de Administrador
    // Solo accesible para usuarios con rol 'admin'
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
        Route::get('/panel', [AdminController::class, 'index'])->name('admin.panel');
        Route::get('/citas', [AdminController::class, 'citas'])->name('admin.citas');
        Route::put('/citas/{id}', [AdminController::class, 'actualizarCita'])->name('admin.citas.update');
        Route::delete('/citas/{id}', [AdminController::class, 'eliminarCita'])->name('admin.citas.delete');
        Route::post('/citas/{cita}/productos', [AdminController::class, 'subirProductos'])->name('admin.citas.productos');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    });
});