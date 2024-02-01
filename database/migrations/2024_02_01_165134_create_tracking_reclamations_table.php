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
        Schema::create('tracking_reclamations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idReclamation')->constrained('reclamations');
            $table->foreignId('idProfesseur')->constrained('professeurs');
            $table->enum('stratu', ['Encours', 'Valide', 'Trituration']);
            $table->string('Repense');
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
        Schema::dropIfExists('tracking_reclamations');
    }
};
