<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adressen', function (Blueprint $table) {
            $table->id();
            $table->string('beschrijving');
            $table->string('straatnaam');
            $table->string('huisnummer');
            $table->string('postcode');
            $table->string('plaatsnaam');
            $table->string('land');
            $table->string('kvk'); // Add this line to store the kvk value
            $table->foreign('kvk')->references('kvk')->on('bedrijven'); // Add foreign key constraint
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adressen');
    }
};
