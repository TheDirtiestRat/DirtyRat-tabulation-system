<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateCategoryLists;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\Score;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Judges = Judge::query()->get();

        return view('judge.list', compact([
            'Judges'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('judge.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'middlename' => 'required',
        ]);

        // generate judge id
        $judge_id = fake()->numerify('0#########');

        // add the record to the database
        Judge::query()->create([
            'judge_id' => $judge_id,
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('surname'),
            'middlename' => $request->input('middlename'),
        ]);

        // redirects to the results page
        return redirect()->route('judge.create')->with('success', 'New Judge (' . $request->firstname . ') added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('judge.show');
    }
    public function show_judges_scores(string $id)
    {
        $judge_list = User::query()->where('type', 'JUDGE')->get(['id', 'name']);
        // if there is none selected
        if ($id > 0) {
            $judge = User::query()->where('id', $id)->first(['id', 'name']);
        } else {
            $judge = User::query()->where('type', '!=', 'ADMIN')->first(['id', 'name']);
        }
        // $judge = User::query()->where('type', 'JUDGE')->where('id', $id)->first(['id', 'name']); 
        $categories = Category::query()->get();
        $criterias = Criteria::query()->get();

        $categories_list = array();
        $candidate_list = array();

        for ($i = 0; $i < $categories->count(); $i++) {
            $var = $categories[$i];
            array_push($categories_list, $var);
        }

        $candidates = CandidateCategoryLists::query()->join('candidates', 'candidate_category_lists.candidate_no', '=', 'candidates.candidate_no')->get();

        

        for ($i = 0; $i < count($candidates); $i++) {
            $var = $candidates[$i]->candidate_no;
            array_push($candidate_list, $var);
        }

        $scores = Score::query()->where('judge', '=', $judge->name)->get();
        // $scores = Score::query()->whereIn('candidate', $candidate_list)->whereIn('category', $categories_list)->groupBy(['candidate', 'category'])->get();

        // dd($scores);
        
        return view('judge.judges-scores', compact(
            'judge',
            'judge_list',
            'candidates',
            'candidate_list',
            'scores',
            'categories',
            'criterias',
        ));
    }
    public function show_judge_scores(string $id)
    {
        // if there is none selected
        if ($id > 0) {
            $judge = Judge::query()->where('id', '=', $id)->first();
        } else {
            $judge = Judge::query()->first();
        }

        // dd($judge);

        $Judges = Judge::query()->get();
        $Categories = Category::query()->get();
        $Criterias = Criteria::query()->get();

        $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        // get the scores of the judge by category and criteria
        $judge_name = $judge->firstname;
        $Scores = Score::query()->where('judge', '=', $judge_name)->get([
            'judge',
            'candidate',
            'category',
            'criteria',
            'score',
        ]);

        return view('judge.scores', compact([
            'Scores',
            'judge',
            'Judges',
            'Categories',
            'Criterias',
            'CandidatesMale',
            'CandidatesFemale',
        ]));
    }

    public function print_pdf_judge_scores(string $id)
    {
        // if there is none selected
        if ($id > 0) {
            $judge = Judge::query()->where('id', '=', $id)->first();
        } else {
            $judge = Judge::query()->first();
        }

        // dd($judge);

        $Judges = Judge::query()->get();
        $Categories = Category::query()->get();
        $Criterias = Criteria::query()->get();

        $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        // get the scores of the judge by category and criteria
        $judge_name = $judge->firstname;
        $Scores = Score::query()->where('judge', '=', $judge_name)->get([
            'judge',
            'candidate',
            'category',
            'criteria',
            'score',
        ]);

        // dd(Data::query()->where('employee_id', '=', $id)->first());

        // print by pdd
        $pdf = Pdf::loadView('pdf.judge_scores', compact([
            'Scores',
            'judge',
            'Judges',
            'Categories',
            'Criterias',
            'CandidatesMale',
            'CandidatesFemale',
        ]));
        // download the pdf
        $pdf->download('invoice.pdf');
        // then stream it
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($id > 0) {
            $Judge = Judge::query()->where('id', '=', $id)->first();
        } else {
            $Judge = [
                'id' => 0,
                'firstname' => 'firstname',
                'middlename' => 'middlename',
                'lastname' => 'lastname',
                'judge_id' => 0000000,
            ];
        }

        return view('judge.edit', compact(['Judge']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'middlename' => 'required',
        ]);

        // get the cadidate info
        $Judge = Judge::query()->where('id', '=', $id)->first();

        if ($Judge == null) {
            return redirect()->route('judge.index')->with('info', 'nothing to update in the records.');
        }

        // generate judge id
        $judge_id = $Judge->judge_id;

        // add the record to the database
        $Judge->update([
            'judge_id' => $judge_id,
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('surname'),
            'middlename' => $request->input('middlename'),
        ]);

        // redirects to the results page
        return redirect()->route('judge.index')->with('success', 'Judge (' . $Judge->firstname . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Judge = Judge::query()->where('id', '=', $id)->first();

        if ($Judge == null) {
            return redirect()->route('judge.index')->with('info', 'nothing to deleted in the records.');
        }

        // delete the cadidate in the records
        $Judge->delete();

        // redirect back to the page
        return redirect()->route('judge.index')->with('success', '' . $Judge->firstname . ' is deleted in the records.');
    }

    public function score_candidates_by_category(string $category_id)
    {
        // if there is none selected
        if ($category_id > 0) {
            $category = Category::query()->where('id', '=', $category_id)->first();
        } else {
            $category = Category::query()->first();
        }

        $Categories = Category::query()->get();
        $Criterias = Criteria::query()->get();

        $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        // get the score by judge and category
        $judge_name = session('Judge_user')[0]->firstname;
        $Scores = Score::query()->where('judge', '=', $judge_name)->where('category', '=', $category->category_id)->get([
            'judge',
            'candidate',
            'category',
            'criteria',
            'score',
        ]);

        // dd($Scores);

        return view('judge.scoring', compact([
            'Scores',
            'category',
            'Categories',
            'Criterias',
            'CandidatesMale',
            'CandidatesFemale',
        ]));
    }

    public function score_top3_candidates(string $category_id)
    {
        $category = Category::query()->where('category_id', '=', $category_id)->first();

        $Categories = Category::query()->get();
        $Criterias = Criteria::query()->get();

        // $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        // $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        $CandidatesMale = Score::query()->selectRaw('`candidate`,  `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, `photo`,  SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Male')->groupBy('candidate', 'contestant_no', 'firstname', 'middlename', 'lastname', 'gender', 'photo')->orderByRaw('`total` DESC')->limit(3)->get();
        $CandidatesFemale = Score::query()->selectRaw('`candidate`,  `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, `photo`,  SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Female')->groupBy('candidate', 'contestant_no', 'firstname', 'middlename', 'lastname', 'gender', 'photo')->orderByRaw('`total` DESC')->limit(3)->get();

        // dd($category);

        // get the score by judge and category
        $judge_name = session('Judge_user')[0]->firstname;
        $Scores = Score::query()->where('judge', '=', $judge_name)->where('category', '=', $category->category_id)->get([
            'judge',
            'candidate',
            'category',
            'criteria',
            'score',
        ]);

        // dd($Scores);

        return view('judge.scoring', compact([
            'Scores',
            'category',
            'Categories',
            'Criterias',
            'CandidatesMale',
            'CandidatesFemale',
        ]));
    }

    public function submit_candidates_scores(Request $request)
    {
        $category = Category::query()->where('category_id', '=', $request->input('category'))->first();

        // dd($request->input());

        // get all the data
        $cadidates_scores = array();

        // if request is empty then redirect back
        if ($request->input('scores') == null && $request->input('category') == '0999') {
            // redirect back to the page
            return redirect()->route('Top3', $category->category_id)->with('error', 'Category ' . $category->title . ' scores not submitted. (empty)');
        }

        for ($i = 0; $i < count($request->input('scores')); $i++) {
            $data = [
                'judge' => $request->input('judge'),
                'candidate' => $request->input('candidates')[$i],
                'category' => $request->input('category'),
                'criteria' => $request->input('criteria')[$i],
                'score' => $request->input('scores')[$i],
            ];

            // add the data if it does not exist in the data base
            $score = Score::query()->where('judge', '=', $request->input('judge'))->where('category', '=', $request->input('category'))->first();
            if ($score == null) {
                array_push($cadidates_scores, $data);
            }
        }

        // dd($cadidates_scores);

        // store the scores in the database
        foreach ($cadidates_scores as $key => $value) {
            Score::query()->create($value);
        }

        // redirect back to the page
        return redirect()->route('scoreByCategory', $category->id)->with('success', 'Candidates ' . $category->title . ' Scores are submitted.');
    }
}
