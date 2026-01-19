<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contestants', function (Blueprint $table) {
            $table->id('contestant_id');
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->string('infix', 15)->nullable();
            $table->double('weight');
            $table->date('date_of_birth');
            $table->string('profile_picture', 255)->nullable();
            $table->boolean('is_present')->default(false);
            $table->boolean('is_weighed')->default(false);

            $table->unsignedBigInteger('club_id');
            $table->foreign('club_id')
                  ->references('club_id')
                  ->on('clubs')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contestants');
    }
};
