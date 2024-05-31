<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\CandidateCategoryLists;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\User;

class PagentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create Judge users
        User::factory()->create([
            'name' => 'Oscar Cabeltis',
            'email' => 'judge1@judge.com',
            'type' => 'JUDGE',
            'password' => 'judge1'
        ]);
        User::factory()->create([
            'name' => 'Carissa Nevel Finn P. Fernandez',
            'email' => 'judge2@judge.com',
            'type' => 'JUDGE',
            'password' => 'judge2'
        ]);
        User::factory()->create([
            'name' => 'Jeffrey E. Belmaro',
            'email' => 'judge3@judge.com',
            'type' => 'JUDGE',
            'password' => 'judge3'
        ]);

        // create the candidates
        Candidate::factory()->create([
            'candidate_no' => '0101',
            'name' => 'CAHEL Sarah Ashley A. Noda - Pharsa',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0101',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0102',
            'name' => 'CAHEL Kirzten Chan Cunag - Hanabi',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0102',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0103',
            'name' => 'CAHEL Katrina T. Misa - Guinevere (interschool)',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0103',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0104',
            'name' => 'CAHEL Dafnie Mae R. Llena - Ruby (interschool)',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0104',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0105',
            'name' => 'CAHEL Lhea Ann Perez - Lou Yi (interschool)',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0105',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0106',
            'name' => 'CAHEL Manace C. Sendico - Ichigo Kurosaki',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0106',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0107',
            'name' => 'CAHEL Kaycelyn Ancheta - Orihime Inoue',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0107',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0108',
            'name' => 'CAHEL Shane Aeron Mantilla - Pina Festival',
            'photo' => 'CAHEL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0108',
            'category_id' => '0112',
        ]);

        Candidate::factory()->create([
            'candidate_no' => '0109',
            'name' => 'VIERRDY San Alburo Mero - Harley',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0109',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0110',
            'name' => 'VIERRDY Earl Gonzaga - Lunox',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0110',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0110',
            'name' => 'VIERRDY Jesmar Baguirguir - Lapu-Lapu (interschoo)',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0110',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0112',
            'name' => 'VIERRDY Lyra Marie P. Blanker - Hanabi (interschoo)',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0112',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0113',
            'name' => 'VIERRDY Marwin Jun Abilar-Gerong - Paguito (interschoo)',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0113',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0114',
            'name' => 'VIERRDY Trisha P. Blanker - Hiyori',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0114',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0115',
            'name' => 'VIERRDY Vincent May Galudo - Zoro',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0115',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0116',
            'name' => 'VIERRDY Jhon Roy Andrin - Panagbenga',
            'photo' => 'VIERRDY.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0116',
            'category_id' => '0112',
        ]);

        Candidate::factory()->create([
            'candidate_no' => '0117',
            'name' => 'GIALLIO Edzelle Joseph V. Caberos - Balmond',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0117',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0118',
            'name' => 'GIALLIO Gilia Dejano Desamparado - Kagura',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0118',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0119',
            'name' => 'GIALLIO Jette Joey Eloise Balena - Lesly (interschool)',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0119',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0120',
            'name' => 'GIALLIO Angel Espina - Guinevere (interschool)',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0120',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0121',
            'name' => 'GIALLIO Sj Pelostratos Jr. - Loid Forger',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0121',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0131',
            'name' => 'GIALLIO Neriel Grace Endrina - Yor Forger',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0131',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0122',
            'name' => 'GIALLIO Clint Malinao - Kadayawan',
            'photo' => 'GIALLIO.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0122',
            'category_id' => '0112',
        ]);

        Candidate::factory()->create([
            'candidate_no' => '0123',
            'name' => 'AZUL Leonard Enero - Gusion',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0123',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0124',
            'name' => 'AZUL Christian Aseo - Chou',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0124',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0125',
            'name' => 'AZUL Baby Jane Roca - Angela (interschool)',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0125',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0126',
            'name' => 'AZUL Ivy Carayang - Fanny (interschool)',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0126',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0127',
            'name' => 'AZUL Katrina Caryl Maudo - Guinevere (interschool)',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0127',
            'category_id' => '0110',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0128',
            'name' => 'AZUL Jovir C. Cabiling - Erza Scarlet',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0128',
            'category_id' => '0113',
        ]);
        Candidate::factory()->create([
            'candidate_no' => '0129',
            'name' => 'AZUL Anzelou C. Hermoso - Jellal Fernandes',
            'photo' => 'AZUL.png',
        ]);
        CandidateCategoryLists::factory()->create([
            'candidate_no' => '0129',
            'category_id' => '0113',
        ]);



        // categories and criterias
        Category::factory()->create([
            'category_id' => '0110',
            'title' => 'Cosplay (ML Heroes) - Interschool',
        ]);

        // Category::factory()->create([
        //     'category_id' => '011',
        //     'title' => 'Mythical Creatures (Anime)',
        // ]);
        Criteria::factory()->create([
            'category' => '0110',
            'name' => 'Creativity',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0110',
            'name' => 'Originality',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0110',
            'name' => 'Delivery/Presentation',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0110',
            'name' => 'Resourcefulness',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0110',
            'name' => 'Relevance to the Theme',
            'points' => '20',
        ]);

        Category::factory()->create([
            'category_id' => '0113',
            'title' => 'Mythical Creatures (Anime)',
        ]);
        Criteria::factory()->create([
            'category' => '0113',
            'name' => 'Creativity',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0113',
            'name' => 'Originality',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0113',
            'name' => 'Delivery/Presentation',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0113',
            'name' => 'Resourcefulness',
            'points' => '20',
        ]);
        Criteria::factory()->create([
            'category' => '0113',
            'name' => 'Relevance to the Theme',
            'points' => '20',
        ]);

        Category::factory()->create([
            'category_id' => '0112',
            'title' => 'Barbie (Festival Queens)',
        ]);
        Criteria::factory()->create([
            'category' => '0112',
            'name' => 'Creativity',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0112',
            'name' => 'Originality',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0112',
            'name' => 'Delivery/Presentation',
            'points' => '25',
        ]);
        Criteria::factory()->create([
            'category' => '0112',
            'name' => 'Resourcefulness',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0112',
            'name' => 'Eloquence',
            'points' => '10',
        ]);
        Criteria::factory()->create([
            'category' => '0112',
            'name' => 'Relevance to the Theme',
            'points' => '20',
        ]);
    }
}
