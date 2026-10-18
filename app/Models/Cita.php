<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'telefono',
        'servicio',
        'fecha',
        'hora',
        'mensaje',
        'estado',
        'productos_path',
        'productos_nombre',
        'productos_subidos_at',
    ];

    protected function casts(): array
    {
        return [
            'productos_subidos_at' => 'datetime',
        ];
    }

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}