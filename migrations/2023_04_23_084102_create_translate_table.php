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
            $table->string('model')->nullable(false);
            $table->string('column')->nullable(false);
            $table->string('key')->nullable(false)->uniaue();
            $table->string('value')->nullable(false);
            $table->string('locale')->nullable(false);
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
