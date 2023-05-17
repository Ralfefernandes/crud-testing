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
            $table->string('geslacht')->nullable()->default(null);
            $table->string('voornaam')->nullable()->default(null);
            $table->string('achternaam')->nullable()->default(null);
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('telefoonnummer_vast')->unique()->nullable()->default(null);
            $table->string('telefoonnummer_mobiel')->unique()->nullable()->default(null);
            $table->text('notities')->nullable()->default(null);
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
