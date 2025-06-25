<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('medecins', function (Blueprint $table) {
    $table->unsignedBigInteger('id')->primary(); // lié à users
    $table->string('license_number');
    $table->integer('years_of_experience');
    $table->string('image')->nullable();
    $table->string('adresse')->nullable();
    $table->text('description')->nullable();
    
    // clé étrangère vers spécialités
    $table->unsignedBigInteger('specialite_id')->nullable();
    
    $table->timestamps();

    // Foreign key vers users
    $table->foreign('id')->references('id')->on('users')->onDelete('cascade');

    // Foreign key vers specialites
    $table->foreign('specialite_id')->references('id')->on('specialite')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
