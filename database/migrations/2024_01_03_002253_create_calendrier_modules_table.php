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
        Schema::create('calendrier_modules', function (Blueprint $table) {
            $table->id();
            $table->date('DateExamen');
            $table->string('Houre');
            $table->unsignedBigInteger('idModule');
            $table->string('AnneeUniversitaire', 10);
            $table->unsignedBigInteger('idSESSION');
            $table->foreign('idSESSION')->references('id')->on('calendrier_sessions');
            $table->foreign('idModule')->references('id')->on('modules');
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
        Schema::dropIfExists('calendrier_modules');
    }
};
