<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournament_years', function (Blueprint $table) {
            $table->id('year_id');
            $table->string('tournament_year', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_years');
    }
};
