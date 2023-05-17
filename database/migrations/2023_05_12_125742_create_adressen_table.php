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
            $table->string('beschrijving')->nullable()->default(null);
            $table->string('straatnaam')->nullable()->default(null);
            $table->string('huisnummer')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('plaatsnaam')->nullable()->default(null);
            $table->string('land')->nullable()->default(null);
            $table->string('kvk')->nullable()->default(null);
            $table->foreign('kvk')->references('kvk')->on('bedrijven'); // Add foreign key constraint
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adressen');
    }
};
