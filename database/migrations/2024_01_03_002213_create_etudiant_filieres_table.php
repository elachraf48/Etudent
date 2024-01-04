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
        Schema::create('etudiants_filieres', function (Blueprint $table) {
            $table->unsignedBigInteger('idEtudiant');
            $table->unsignedBigInteger('idFiliere');
            $table->primary(['idEtudiant', 'idFiliere']);
            $table->foreign('idFiliere')->references('id')->on('filieres');
            $table->foreign('idEtudiant')->references('id')->on('etudiants');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etudiant_filieres');
    }
};
