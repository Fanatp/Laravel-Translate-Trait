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
        Schema::create('translate', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('column');
            $table->unsignedBigInteger('key');
            $table->string('locale', 10);
            $table->text('value');

            $table->unique(['model', 'column', 'key', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translate');
    }
};
