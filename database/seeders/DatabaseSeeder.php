<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        for ($i = 1; $i <= 15; $i++) {
            $user = User::firstOrCreate(
                ['email' => sprintf('cliente%02d@example.com', $i)],
                [
                    'name' => 'Cliente Demo '.$i,
                    'password' => Hash::make('password'),
                    'role' => 'user',
                ]
            );

            if (! $user->citas()->exists()) {
                Cita::create([
                    'user_id' => $user->id,
                    'nombre' => $user->name,
                    'email' => $user->email,
                    'telefono' => '555-010-'.str_pad((string) $i, 2, '0', STR_PAD_LEFT),
                    'servicio' => ['basico', 'premium', 'boda'][($i - 1) % 3],
                    'fecha' => now()->addDays($i)->toDateString(),
                    'hora' => sprintf('%02d:00:00', 9 + (($i - 1) % 8)),
                    'mensaje' => 'Cita de demostración '.$i,
                    'estado' => ['pendiente', 'confirmada', 'completada'][($i - 1) % 3],
                ]);
            }
        }
    }
}
