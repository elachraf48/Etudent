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
        Schema::create('info_exames', function (Blueprint $table) {
            $table->id();
            $table->integer('NumeroExamen');
            $table->string('Semester', 5);
            $table->string('AnneeUniversitaire', 10);
            $table->string('Lieu');
            $table->unsignedBigInteger('idEtudiant');
            $table->unsignedBigInteger('idGroupe');
            $table->unsignedBigInteger('idSession');
            $table->foreign('idSession')->references('id')->on('calendrier_sessions');
            $table->foreign('idEtudiant')->references('id')->on('etudiants');
            $table->foreign('idGroupe')->references('id')->on('groupes');
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
        Schema::dropIfExists('info_exames');
    }
};
