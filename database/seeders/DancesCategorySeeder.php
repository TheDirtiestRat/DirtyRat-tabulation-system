<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\CandidateCategoryLists;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\User;

class DancesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // APRIL 24 AFTERNOON
        
        Category::factory()->create([
            'category_id' => '0107',
            'title' => 'Feet Republik',
        ]);
        Criteria::factory()->create([
            'category' => '0107',
            'name' => 'Overall Effect (Showmanship, Entertainment, Value, Attire)',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0107',
            'name' => 'Choreography (Creativity, Variety, Uniqueness)',
            'points' => '50',
        ]);
        Criteria::factory()->create([
            'category' => '0107',
            'name' => 'Technique (Musicality, Synchronization/Timing, Spacing & Formations)',
            'points' => '25',
        ]);

        // Candidate::factory()->create([
        //     'candidate_no' => '01',
        //     'name' => fake()->name(),
        //     'photo' => 'aclc.png',
        // ]);
        // CandidateCategoryLists::factory()->create([
        //     'candidate_no' => '01',
        //     'category_id' => '0107',
        // ]);
        // Candidate::factory()->create([
        //     'candidate_no' => '02',
        //     'name' => fake()->name(),
        //     'photo' => 'aclc.png',
        // ]);
        // CandidateCategoryLists::factory()->create([
        //     'candidate_no' => '02',
        //     'category_id' => '0107',
        // ]);
        // Candidate::factory()->create([
        //     'candidate_no' => '03',
        //     'name' => fake()->name(),
        //     'photo' => 'aclc.png',
        // ]);
        // CandidateCategoryLists::factory()->create([
        //     'candidate_no' => '03',
        //     'category_id' => '0107',
        // ]);
        // Candidate::factory()->create([
        //     'candidate_no' => '04',
        //     'name' => fake()->name(),
        //     'photo' => 'aclc.png',
        // ]);
        // CandidateCategoryLists::factory()->create([
        //     'candidate_no' => '04',
        //     'category_id' => '0107',
        // ]);
        // Candidate::factory()->create([
        //     'candidate_no' => '05',
        //     'name' => fake()->name(),
        //     'photo' => 'aclc.png',
        // ]);
        // CandidateCategoryLists::factory()->create([
        //     'candidate_no' => '05',
        //     'category_id' => '0107',
        // ]);

        Category::factory()->create([
            'category_id' => '0108',
            'title' => 'Sing Alike',
        ]);
        Criteria::factory()->create([
            'category' => '0108',
            'name' => 'Concept',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0108',
            'name' => 'Sing-alike abilities',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0108',
            'name' => 'Overall Performance',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0108',
            'name' => 'Costume & Props',
            'points' => '15',
        ]);

        Category::factory()->create([
            'category_id' => '0109',
            'title' => 'Modern Folk Dance',
        ]);
        Criteria::factory()->create([
            'category' => '0109',
            'name' => 'Choreography',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0109',
            'name' => 'Performance',
            'points' => '40',
        ]);
        Criteria::factory()->create([
            'category' => '0109',
            'name' => 'Costume',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0109',
            'name' => 'Choice of Music',
            'points' => '10',
        ]);
    }
}
