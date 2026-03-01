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
        Schema::create('category_options', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->string('option_key');        // 'gato', 'playa', etc.
    $table->string('icon');              // emoji del icono
    $table->string('label');             // 'Gato' (texto visible al usuario)
    $table->text('prompt_text');         // 'un gato tierno' (va al prompt)
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
        Schema::dropIfExists('category_options');
    }
};
