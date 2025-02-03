<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignIdFor(Client::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedDecimal('monto_total', 8 , 2);
            $table->dateTime('fecha_hora_venta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
