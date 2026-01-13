<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id('club_id');
            $table->string('club_name', 50);
            $table->string('location', 100);
            $table->string('country', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
