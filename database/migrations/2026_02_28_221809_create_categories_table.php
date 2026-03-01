<?php

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
        Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();     // 'personaje', 'estilo', etc.
    $table->string('label');             // 'Personaje principal'
    $table->string('emoji');             // 'EE80A0' (emoji)
    $table->string('prompt_key');        // slot en la plantilla: ':personaje'
    $table->string('default_text');      // fallback si no hay seleccion
    $table->integer('order')->default(0);
    $table->boolean('active')->default(true);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
