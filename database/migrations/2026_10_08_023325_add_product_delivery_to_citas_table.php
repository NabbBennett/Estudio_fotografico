<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->string('productos_path')->nullable()->after('estado');
            $table->string('productos_nombre')->nullable()->after('productos_path');
            $table->timestamp('productos_subidos_at')->nullable()->after('productos_nombre');
        });
    }

    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn([
                'productos_path',
                'productos_nombre',
                'productos_subidos_at',
            ]);
        });
    }
};
