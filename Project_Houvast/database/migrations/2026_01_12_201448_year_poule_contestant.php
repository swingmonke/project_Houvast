<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('year_poule_contestant', function (Blueprint $table) {
            $table->unsignedBigInteger('contestant_id');
            $table->unsignedBigInteger('poule_id');
            $table->unsignedBigInteger('year_id');

            $table->primary(['contestant_id', 'poule_id', 'year_id']);

            $table->foreign('contestant_id')
                  ->references('contestant_id')
                  ->on('contestants')
                  ->cascadeOnDelete();

            $table->foreign('poule_id')
                  ->references('poule_id')
                  ->on('poules')
                  ->cascadeOnDelete();

            $table->foreign('year_id')
                  ->references('year_id')
                  ->on('tournament_years')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('year_poule_contestant');
    }
};
