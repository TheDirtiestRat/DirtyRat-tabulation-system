<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateCategoryLists;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\Judge;
use App\Models\Score;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        // $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        $candidates = Candidate::query()->latest()->get();
        // $candidate_join_category = Candidate::query()->join('candidate_category_lists', 'candidates.candidate_no', '=', 'candidate_category_lists.candidate_no')->join('categories', 'candidate_category_lists.category_id', '=', 'categories.category_id')->get(['candidates.candidate_no', 'categories.category_id']);

        $category_list = CandidateCategoryLists::query()->join('categories', 'candidate_category_lists.category_id', '=', 'categories.category_id')->get();

        // dd($candidate_join_category);

        return view('candidate.list', compact([
            'candidates',
            'category_list',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->latest()->get();

        return view('candidate.create', compact('categories'));
    }

    public function score_candidate(string $category_id)
    {
        $category = Category::query()->where('category_id', $category_id)->first();
        $candidates = CandidateCategoryLists::query()->where('category_id', $category->category_id)->join('candidates', 'candidate_category_lists.candidate_no', '=', 'candidates.candidate_no')->get();
        $criterias = Criteria::query()->where('category', $category->category_id)->get();

        $candidate_list = array();

        for ($i=0; $i < $candidates->count(); $i++) {
            $data = $candidates[$i]->candidate_no;
            array_push($candidate_list, $data);
        }

        // $scores = Score::query()->selectRaw("WHERE `judge` = '".Auth::user()->name."' AND `candidate` IN (53,66) AND `category` = 0101;")->get();
        $scores = Score::query()->where('category', $category_id)->whereIn('candidate', $candidate_list)->where('judge', Auth::user()->name)->get();

        // dd($scores);

        return view('candidate.scoring', compact('category', 'candidates', 'scores', 'criterias'));
    }

    public function record_score_candidate(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'judge' => 'required',
            'candidates' => 'required',
            'criteria' => 'required',
            'scores' => 'required',
        ]);

        // dd($request->input());

        // list the candidates joined categories
        for ($i = 0; $i < count($request->input('scores')); $i++) {
            Score::query()->create([
                'judge' => $request->input('judge'),
                'candidate' => $request->input('candidates')[$i],
                'category' => $request->input('category'),
                'criteria' => $request->input('criteria')[$i],
                'score' => $request->input('scores')[$i],
            ]);
        }

        // redirects to the results page
        return redirect()->route('scoreCandidate', $request->input('category'))->with('success', 'Scores Submitted.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'firstname' => 'required',
            // 'surname' => 'required',
            'name' => 'required',
            'categories' => 'required',
            // 'gender' => 'required',
            // 'contestant_no' => 'required',
        ]);

        // contestant generate no
        $candidate_no = fake()->numerify('#########');

        // dd($request->input());

        // add the photo
        $newPhotoName = 'aclc.png';
        if ($request->photo != null) {
            $newPhotoName = time() . "-" . $request->name . "." . $request->photo->guessExtension();
            $request->file('photo')->storeAs('images', $newPhotoName, 'public');
            // $request->file('photo')->storeAs('public/images', $newPhotoName);
        }

        // add the record to the database
        Candidate::query()->create([
            // 'contestant_no' => $request->input('contestant_no'),
            // 'firstname' => $request->input('firstname'),
            // 'lastname' => $request->input('surname'),
            // 'middlename' => $request->input('middlename'),
            // 'gender' => $request->input('gender'),
            // 'photo' => $newPhotoName,
            'candidate_no' => $candidate_no,
            'name' => $request->input('name'),
            'photo' => $newPhotoName,
        ]);

        // list the candidates joined categories
        for ($i = 0; $i < count($request->input('categories')); $i++) {
            CandidateCategoryLists::query()->create([
                'candidate_no' => $candidate_no,
                'category_id' => $request->input('categories')[$i],
            ]);
        }

        // redirects to the results page
        return redirect()->route('candidate.create')->with('success', 'New Candidates (' . $request->name . ') added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('candidate.show');
    }

    public function show_candidates_scores(string $id)
    {
        // if there is none selected
        if ($id > 0) {
            $category = Category::query()->where('id', '=', $id)->first();
        } else {
            $category = Category::query()->first();
        }

        // dd($judge);

        $Judges = Judge::query()->get();
        $Categories = Category::query()->get();
        $Criterias = Criteria::query()->get();

        // $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        // $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        $TotalsMale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Male')->groupBy('candidate', 'criteria')->orderByRaw('`total` DESC')->get();
        $TotalsFemale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Female')->groupBy('candidate', 'criteria')->orderByRaw('`total` DESC')->get();

        // dd($TotalsMale);

        // get candidates scores
        $category_id = $category->category_id;
        $Scores = Score::query()->where('category', '=', $category_id)->get([
            'judge',
            'candidate',
            'category',
            'criteria',
            'score',
        ]);

        // dd($Scores);

        return view('candidate.scores', compact([
            'Scores',
            'TotalsMale',
            'TotalsFemale',
            'category',
            'Judges',
            'Categories',
            'Criterias',
            // 'CandidatesMale',
            // 'CandidatesFemale',
        ]));
    }

    public function print_candidates_scores(string $id)
    {
        // if there is none selected
        if ($id > 0) {
            $category = Category::query()->where('id', '=', $id)->first();
        } else {
            $category = Category::query()->first();
        }

        // dd($judge);

        $Judges = Judge::query()->get();
        $Categories = Category::query()->get();
        $Criterias = Criteria::query()->get();

        $TotalsMale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Male')->groupBy('candidate', 'criteria')->orderByRaw('`total` DESC')->get();
        $TotalsFemale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Female')->groupBy('candidate', 'criteria')->orderByRaw('`total` DESC')->get();

        // get candidates scores
        $category_id = $category->category_id;
        $Scores = Score::query()->where('category', '=', $category_id)->get([
            'judge',
            'candidate',
            'category',
            'criteria',
            'score',
        ]);

        // dd($Scores);

        // print by pdd
        $pdf = Pdf::loadView('pdf.candidate_scores', compact([
            'Scores',
            'category',
            'Judges',
            'Categories',
            'Criterias',
            'TotalsMale',
            'TotalsFemale',
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
        // if ($id > 0) {
        //     $Candidate = Candidate::query()->where('id', '=', $id)->first();
        // } else {
        //     $Candidate = [
        //         'id' => $id,
        //         'firstname' => 'firstname',
        //         'middlename' => 'middlename',
        //         'lastname' => 'lastname',
        //         'gender' => 'others',
        //         'photo' => 'aclc.png',
        //         'contestant_no' => 00,
        //     ];
        // }

        $candidate = Candidate::query()->where('id', $id)->first();
        $category_list = Category::query()->latest()->get();
        $categories_joined = CandidateCategoryLists::query()->where('candidate_no', $candidate->candidate_no)->get();

        $categories = array();

        for ($i = 0; $i < $category_list->count(); $i++) {
            // check if it has joined any category
            $is_joined = false;
            for ($j = 0; $j < $categories_joined->count(); $j++) {
                if ($categories_joined[$j]->category_id == $category_list[$i]->category_id) {
                    $is_joined = true;
                }
            }

            // assign the joined and not joined category
            $data = [
                'id' => $category_list[$i]->id,
                'category_id' => $category_list[$i]->category_id,
                'title' => $category_list[$i]->title,
                'joined' => $is_joined,
            ];
            array_push($categories, $data);
        }

        // dd($categories);

        return view('candidate.edit', compact([
            'candidate',
            'categories',
            // 'categories_joined',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'categories' => 'required',
        ]);

        $candidate = Candidate::query()->where('id', '=', $id)->first();

        // dd($request->input());

        // add the photo
        $newPhotoName = $candidate->photo;
        if ($request->photo != null) {
            $newPhotoName = time() . "-" . $request->name . "." . $request->photo->guessExtension();
            $request->file('photo')->storeAs('images', $newPhotoName, 'public');
        }

        // add the record to the database
        Candidate::query()->where('id', $id)->update([
            // 'candidate_no' => $candidate_no,
            'name' => $request->input('name'),
            'photo' => $newPhotoName,
        ]);

        // removes all the candidates joined categories
        CandidateCategoryLists::query()->where('candidate_no', $candidate->candidate_no)->delete();


        // list the candidates joined categories
        for ($i = 0; $i < count($request->input('categories')); $i++) {
            CandidateCategoryLists::query()->create([
                'candidate_no' => $candidate->candidate_no,
                'category_id' => $request->input('categories')[$i],
            ]);
        }

        // redirects to the results page
        return redirect()->route('candidate.index')->with('success', 'Candidate (' . $request->name . ') Updated.');

        // $request->validate([
        //     'firstname' => 'required',
        //     'surname' => 'required',
        //     'middlename' => 'required',
        //     'gender' => 'required',
        //     'contestant_no' => 'required',
        // ]);

        // // get the cadidate info
        // $Candidate = Candidate::query()->where('id', '=', $id)->first();

        // if ($Candidate == null) {
        //     return redirect()->route('candidate.index')->with('info', 'nothing to update in the records.');
        // }

        // // contestant generate no
        // $con_no = $request->input('contestant_no');

        // // dd($request->file('photo'));

        // // add the photo
        // $newPhotoName = '';
        // if ($request->photo != null) {
        //     $newPhotoName = time() . "-" . $request->firstname . "." . $request->photo->guessExtension();
        //     $request->file('photo')->storeAs('images', $newPhotoName, 'public');
        //     // $request->file('photo')->storeAs('public/images', $newPhotoName);
        // } else {
        //     $newPhotoName = $Candidate->photo;
        // }

        // // add the record to the database
        // $Candidate->update([
        //     'contestant_no' => $con_no,
        //     'firstname' => $request->input('firstname'),
        //     'lastname' => $request->input('surname'),
        //     'middlename' => $request->input('middlename'),
        //     'gender' => $request->input('gender'),
        //     'photo' => $newPhotoName,
        // ]);

        // // redirects to the results page
        // return redirect()->route('candidate.index')->with('success', 'Candidates (' . $Candidate->firstname . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Candidate = Candidate::query()->where('id', '=', $id)->first();

        if ($Candidate == null) {
            return redirect()->route('candidate.index')->with('info', 'nothing to deleted in the records.');
        }

        $destination = "storage/images/" . $Candidate->photo;
        if (File::exists($destination) && $Candidate->photo != 'aclc.png') {
            File::delete($destination);
        }

        // delete the cadidate in the records
        $Candidate->delete();

        // redirect back to the page
        return redirect()->route('candidate.index')->with('success', '' . $Candidate->firstname . ' is deleted in the records.');
    }
}
