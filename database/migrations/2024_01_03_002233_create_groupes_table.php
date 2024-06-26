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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id();
            $table->string('nomGroupe', 10);
            $table->string('Semester', 5);
            $table->string('AnneeUniversitaire', 10);
            $table->unsignedBigInteger('idSESSION');
            $table->foreign('idSESSION')->references('id')->on('calendrier_sessions');
            $table->unique(['AnneeUniversitaire','nomGroupe', 'Semester', 'idSESSION']);
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
        Schema::dropIfExists('groupes');
    }
};




