<?php

use App\Models\Product;
use App\Models\Sale;
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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Product::class)->constrained()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('cantidad');
            $table->unsignedDecimal('precio_unitario', 8, 2);
            $table->unsignedDecimal('sub_total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
