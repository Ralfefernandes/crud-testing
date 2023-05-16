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
            $table->string('beschrijving')->default('');
            $table->string('straatnaam')->default('');
            $table->string('huisnummer')->default('');
            $table->string('postcode')->default('');
            $table->string('plaatsnaam')->default('');
            $table->string('land')->default('');
            $table->string('kvk')->default(''); // Add this line to store the kvk value
            $table->foreign('kvk')->references('kvk')->on('bedrijven'); // Add foreign key constraint
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adressen');
    }
};
