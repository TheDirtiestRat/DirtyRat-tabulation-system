<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'dunhill@dunhill.com',
            'type' => 'ADMIN',
            'password' => 'admin'
        ]);

        // // create Judge users
        // User::factory()->create([
        //     'name' => 'Judge1',
        //     'email' => 'judge1@judge.com',
        //     'type' => 'JUDGE',
        //     'password' => 'judge1'
        // ]);
        // User::factory()->create([
        //     'name' => 'Judge2',
        //     'email' => 'judge2@judge.com',
        //     'type' => 'JUDGE',
        //     'password' => 'judge2'
        // ]);
        // User::factory()->create([
        //     'name' => 'Judge3',
        //     'email' => 'judge3@judge.com',
        //     'type' => 'JUDGE',
        //     'password' => 'judge3'
        // ]);

        // create default candidates
        Candidate::factory()->create([ 
            'candidate_no' => fake()->numerify('#########'),
            'name' => 'House AZUL',
            'photo' => 'AZUL.png',
        ]);
        Candidate::factory()->create([ 
            'candidate_no' => fake()->numerify('#########'),
            'name' => 'House CAHEL',
            'photo' => 'CAHEL.png',
        ]);
        Candidate::factory()->create([ 
            'candidate_no' => fake()->numerify('#########'),
            'name' => 'House GIALLIO',
            'photo' => 'GIALLIO.png',
        ]);
        Candidate::factory()->create([ 
            'candidate_no' => fake()->numerify('#########'),
            'name' => 'House ROXXO',
            'photo' => 'ROXXO.png',
        ]);
        Candidate::factory()->create([ 
            'candidate_no' => fake()->numerify('#########'),
            'name' => 'House VIERRDY',
            'photo' => 'VIERRDY.png',
        ]);

        

        $this->call([
            LitmusSeeder::class,
            // DancesCategorySeeder::class,
            // PagentSeeder::class,
        ]);
    }
}
