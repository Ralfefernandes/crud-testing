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
        Schema::create('bedrijven', function (Blueprint $table) {
            $table->id();
            $table->string('bedrijfsnaam')->nullable()->default(null);
            $table->string('kvk')->unique()->nullable()->default(null); // Make 'kvk' column unique
            $table->string('btw')->unique()->nullable()->default(null); // Make 'btw' column unique
            $table->string('land_van_vestiging')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bedrijven');
    }
};
