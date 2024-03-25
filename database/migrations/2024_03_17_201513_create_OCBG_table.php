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
        Schema::create('ocbg', function (Blueprint $table) {
            $table->id();
            $table->string('numero_OP')->unique();
            $table->string('section');
            $table->date('Date_regèlement');
            $table->string('libelle');
            $table->string('montant');
            $table->enum('justification', ['non', 'oui'])->default('non');
            $table->string('pdf_file_path')->nullable(); // Changed default value to nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocbg');
    }
};
