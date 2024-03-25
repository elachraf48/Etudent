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
        Schema::create('groupe_etudiant', function (Blueprint $table) {
            $table->unsignedBigInteger('idEtudiant');
            $table->unsignedBigInteger('idGroupe');
            $table->primary(['idEtudiant', 'idGroupe']);
            $table->foreign('idEtudiant')->references('id')->on('etudiants');
            $table->foreign('idGroupe')->references('id')->on('groupes');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupe_etudiants');
    }
};
