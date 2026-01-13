<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brackets', function (Blueprint $table) {
            $table->id('bracket_id');
            $table->string('bracket_name', 30);
            $table->double('weight_class');
            $table->string('location', 10);
            $table->integer('age');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brackets');
    }
};
