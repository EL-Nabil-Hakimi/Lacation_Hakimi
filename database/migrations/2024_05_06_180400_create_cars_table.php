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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->enum('type_carburant', ['Essence', 'Diesel', 'Hybride', 'Électrique', 'Autre']);
            $table->enum('transmission', ['Manuelle', 'Automatique', 'Autre']);
            $table->unsignedTinyInteger('nombre_de_sieges');
            $table->unsignedSmallInteger('capacite_coffre');
            $table->decimal('prix_par_jour', 10, 2); 
            $table->boolean('disponibilite')->nullable()->default(true);
            $table->boolean('accepte')->nullable()->default(false);
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('car_companies')->onDelete('cascade');
            
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on('model_cars')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
