<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilanPredictif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('medecin_id')->nullable()->constrained('medecins')->onDelete('cascade');
            $table->boolean('abdo');
            $table->boolean('nause');
            $table->boolean('fatigue');
            $table->boolean('fievre');
            $table->boolean('jaune');
            $table->boolean('articulation');
            $table->boolean('urine');
            $table->boolean('selle');
            $table->boolean('appetit');
            $table->boolean('tete');
            $table->boolean('prediction')->nullable();
            $table->boolean('resultat')->nullable(); 
            $table->date("date")->useCurrent();              
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

    }
};
