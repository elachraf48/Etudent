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
        Schema::create('calendrier_module_groupes', function (Blueprint $table) {
            $table->unsignedBigInteger('idCmodule');
            $table->unsignedBigInteger('idGroupe');
            $table->primary(['idCmodule', 'idGroupe']);
            $table->foreign('idCmodule')->references('id')->on('calendrier_modules');
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
        Schema::dropIfExists('calendrier_module_groupes');
    }
};
