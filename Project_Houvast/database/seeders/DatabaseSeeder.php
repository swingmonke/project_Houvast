<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Club;
use App\Models\Contestant;
use App\Models\Poule;
use App\Models\Bracket;
use App\Models\TournamentYear;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */ 
    public function run(): void
    {
        // User::factory(10)->create();
        Club::factory(5)->create();

        TournamentYear::factory(1)->create();

        Poule::factory(4)->create();
        Bracket::factory(4)->create();

        Contestant::factory(20)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );
    }
}
