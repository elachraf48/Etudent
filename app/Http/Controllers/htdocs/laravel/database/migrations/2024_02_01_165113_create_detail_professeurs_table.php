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
        Schema::create('detail_professeurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProfesseur')->constrained('professeurs');
            $table->foreignId('idModule')->constrained('modules');
            $table->foreignId('idGroupe')->constrained('groupes');
            $table->string('AnneeUniversitaire');
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
        Schema::dropIfExists('detail_professeurs');
    }
};
