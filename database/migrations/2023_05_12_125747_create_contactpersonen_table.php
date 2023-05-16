<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contactpersonen', function (Blueprint $table) {
            $table->id();
            $table->string('geslacht')->default(' ');
            $table->string('voornaam')->default(' ');
            $table->string('achternaam')->default(' ');
            $table->string('email')->unique()->default('');
            $table->string('telefoonnummer_vast')->unique()->default('');
            $table->string('telefoonnummer_mobiel')->unique()->default('');
            $table->text('notities')->nullable();
            $table->string('kvk');
            $table->foreign('kvk')->references('kvk')->on('bedrijven'); // Add foreign key constraint
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contactpersonen');
    }
};
