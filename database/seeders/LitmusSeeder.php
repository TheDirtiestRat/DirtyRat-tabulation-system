<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\User;

class LitmusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // create Judge users
        User::factory()->create([
            'name' => 'Dominic S. Cayang',
            'email' => 'judge1@judge.com',
            'type' => 'JUDGE',
            'password' => 'judge1'
        ]);
        User::factory()->create([
            'name' => 'Jhuncil Joemar Bobares',
            'email' => 'judge2@judge.com',
            'type' => 'JUDGE',
            'password' => 'judge2'
        ]);
        User::factory()->create([
            'name' => 'Nanet Pacuan',
            'email' => 'judge3@judge.com',
            'type' => 'JUDGE',
            'password' => 'judge3'
        ]);

        // create the category with its criteria

        // DAY 2 APRIL 23 AFTERNOON
        Category::factory()->create([
            'category_id' => '0101',
            'title' => 'Declamation Contest',
        ]);
        Criteria::factory()->create([
            'category' => '0101',
            'name' => 'Delivery & Projection',
            'points' => '35',
        ]);
        Criteria::factory()->create([
            'category' => '0101',
            'name' => 'Clarity & Voice',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0101',
            'name' => 'Mastery',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0101',
            'name' => 'Costume & Props',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0101',
            'name' => 'Overall Impact',
            'points' => '10',
        ]);

        Category::factory()->create([
            'category_id' => '0102',
            'title' => 'Vocal Solo',
        ]);
        Criteria::factory()->create([
            'category' => '0102',
            'name' => 'Vocal Technique',
            'points' => '35',
        ]);
        Criteria::factory()->create([
            'category' => '0102',
            'name' => 'Rhythm and Tempo',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0102',
            'name' => 'Expression or Performance',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0102',
            'name' => 'Stage Presence',
            'points' => '10',
        ]);

        Category::factory()->create([
            'category_id' => '0103',
            'title' => 'Vocal Duet',
        ]);
        Criteria::factory()->create([
            'category' => '0103',
            'name' => 'Vocal Technique',
            'points' => '40',
        ]);
        Criteria::factory()->create([
            'category' => '0103',
            'name' => 'Harmony and Blend',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0103',
            'name' => 'Stage Presence',
            'points' => '15',
        ]);
        Criteria::factory()->create([
            'category' => '0103',
            'name' => 'Choice of Song',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0103',
            'name' => 'Audience Impact',
            'points' => '10',
        ]);

        // BAND ERA CATEGORY
        Category::factory()->create([
            'category_id' => '0104',
            'title' => 'Original Band Competition',
        ]);
        Criteria::factory()->create([
            'category' => '0104',
            'name' => 'Relevance to the Theme',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0104',
            'name' => 'Originality & Creativity',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0104',
            'name' => 'Presentation',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0104',
            'name' => 'Voice Quality',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0104',
            'name' => 'Audience Impact',
            'points' => '10',
        ]);

        Category::factory()->create([
            'category_id' => '0105',
            'title' => 'Band Cover',
        ]);
        Criteria::factory()->create([
            'category' => '0105',
            'name' => 'Mastery & Synchronization',
            'points' => '30',
        ]);
        Criteria::factory()->create([
            'category' => '0105',
            'name' => 'Voice Quality or Blending',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0105',
            'name' => 'Relevance to the Theme',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0105',
            'name' => 'Presentation',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0105',
            'name' => 'Audience Impact',
            'points' => '10',
        ]);

        // Category::factory()->create([
        //     'category_id' => '0106',
        //     'title' => 'String Flicks',
        // ]);
        // Criteria::factory()->create([
        //     'category' => '0106',
        //     'name' => 'Vocal & String Harmony',
        //     'points' => '40',
        // ]);
        // Criteria::factory()->create([
        //     'category' => '0106',
        //     'name' => 'Originality & Creativity',
        //     'points' => '40',
        // ]);
        // Criteria::factory()->create([
        //     'category' => '0106',
        //     'name' => 'Stage Department',
        //     'points' => '10',
        // ]);
        // Criteria::factory()->create([
        //     'category' => '0106',
        //     'name' => 'Audience Impact',
        //     'points' => '10',
        // ]);
    }
}
