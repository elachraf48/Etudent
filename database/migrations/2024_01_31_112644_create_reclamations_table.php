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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->string('AnneeUniversitaire');
            $table->foreignId('idEtudiant')->constrained('etudiants');
            $table->foreignId('idProfesseur')->constrained('professeurs');
            $table->foreignId('idModule')->constrained('modules');
            $table->foreignId('idInfo_Exames')->constrained('info_exames');
            $table->foreignId('idSESSION')->constrained('calendrier_sessions');
            $table->string('Sujet');
            $table->text('observations');
            $table->integer('code_tracking');
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
        Schema::dropIfExists('reclamations');
    }
};
