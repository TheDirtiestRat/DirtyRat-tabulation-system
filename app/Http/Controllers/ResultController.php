<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\Judge;
use App\Models\Score;
use App\Models\CandidateCategoryLists;
use App\Models\Criteria;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function results(Request $request)
    {
        // $data = $request->input();
        $categories_list = array();
        $candidate_list = array();

        // dd($category_keys);

        if ($request->input('categories') != null) {
            for ($i = 0; $i < count($request->input('categories')); $i++) {
                $var = $request->input('categories')[$i];
                array_push($categories_list, $var);
            }
        }

        // dd($categories_list);

        $candidates = CandidateCategoryLists::query()->whereIn('category_id', $categories_list)->join('candidates', 'candidate_category_lists.candidate_no', '=', 'candidates.candidate_no')->groupBy(['name'])->get();
        $categories = Category::query()->whereIn('category_id', $categories_list)->get();

        for ($i = 0; $i < count($candidates); $i++) {
            $var = $candidates[$i]->candidate_no;
            array_push($candidate_list, $var);
        }

        $scores = Score::query()->selectRaw('`candidate`, `category`, SUM(`score`) as "score"')->whereIn('candidate', $candidate_list)->whereIn('category', $categories_list)->groupBy(['candidate', 'category'])->get();

        $total_points = Criteria::query()->selectRaw('SUM(`points`) as "total"')->whereIn('category', $categories_list)->first();
        // not included the admin
        $judge_count = User::query()->where('type', 'JUDGE')->count();
        $overall_point_total = $total_points->total * $judge_count;

        // dd($overall_point_total);

        return view('results.results', compact('candidates', 'categories', 'scores', 'judge_count', 'overall_point_total'));
    }

    public function printable_results(Request $request)
    {
        // $data = $request->input();

        $categories_list = array();
        $candidate_list = array();

        if ($request->input('categories') != null) {
            for ($i = 0; $i < count($request->input('categories')); $i++) {
                $var = $request->input('categories')[$i];
                array_push($categories_list, $var);
            }
        }

        // dd($categories_list);

        $candidates = CandidateCategoryLists::query()->whereIn('category_id', $categories_list)->join('candidates', 'candidate_category_lists.candidate_no', '=', 'candidates.candidate_no')->groupBy(['name'])->get();
        $categories = Category::query()->whereIn('category_id', $categories_list)->get();

        for ($i = 0; $i < count($candidates); $i++) {
            $var = $candidates[$i]->candidate_no;
            array_push($candidate_list, $var);
        }

        $scores = Score::query()->selectRaw('`candidate`, `category`, SUM(`score`) as "score"')->whereIn('candidate', $candidate_list)->whereIn('category', $categories_list)->groupBy(['candidate', 'category'])->get();

        $total_points = Criteria::query()->selectRaw('SUM(`points`) as "total"')->whereIn('category', $categories_list)->first();
        // not included the admin
        $judge_count = User::query()->where('type', 'JUDGE')->count();
        $overall_point_total = $total_points->total * $judge_count;
        $judges_name = User::query()->where('type', 'JUDGE')->get('name');

        // dd($overall_point_total);

        return view('pdf.printable-results', compact('judges_name', 'candidates', 'categories', 'scores', 'judge_count', 'overall_point_total'));
    }

    public function printable_judge_scores(string $id)
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
        
        return view('pdf.printable-judge-scores', compact(
            'judge',
            'judge_list',
            'candidates',
            'candidate_list',
            'scores',
            'categories',
            'criterias',
        ));
    }

    public function show_total_results()
    {
        $Categories = Category::query()->where('category_id', '!=', '0999')->get();

        $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        // add all criteria scores by category
        $Scores = Score::query()->selectRaw('`candidate`, `category`, SUM(`score`) AS score')->where('category', '!=', '0999')->groupBy(['candidate', 'category'])->get();
        // get the total average of all category
        // $Totals = Score::query()->selectRaw('`candidate`, SUM(`score`) AS total')->groupBy('candidate')->orderBy('total', 'desc')->get();
        $TotalsMale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Male')->where('category', '!=', '0999')->groupBy('candidate')->orderByRaw('`total` DESC')->get();
        $TotalsFemale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Female')->where('category', '!=', '0999')->groupBy('candidate')->orderByRaw('`total` DESC')->get();

        // dd($male_candidates);

        // dd($TotalsMale);

        return view('results.total', compact([
            'TotalsMale',
            'TotalsFemale',
            'Scores',
            'Categories',
            'CandidatesMale',
            'CandidatesFemale',
        ]));
    }

    public function print_pdf_total_scores()
    {
        $Judges = Judge::query()->get();
        $Categories = Category::query()->where('category_id', '!=', '0999')->get();

        $CandidatesMale = Candidate::query()->where('gender', '=', 'Male')->get();
        $CandidatesFemale = Candidate::query()->where('gender', '=', 'Female')->get();

        // add all criteria scores by category
        $Scores = Score::query()->selectRaw('`candidate`, `category`, SUM(`score`) AS score')->groupBy(['candidate', 'category'])->get();
        // get the total average of all category
        $TotalsMale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Male')->where('category', '!=', '0999')->groupBy('candidate')->orderByRaw('`total` DESC')->get();
        $TotalsFemale = Score::query()->selectRaw('`judge`, `candidate`, `category`, `criteria`, `contestant_no`, `firstname`, `middlename`, `lastname`, `gender`, SUM(`score`) AS total')->join('candidates', 'scores.candidate', '=', 'candidates.firstname')->where('gender', '=', 'Female')->where('category', '!=', '0999')->groupBy('candidate')->orderByRaw('`total` DESC')->get();

        // dd(Data::query()->where('employee_id', '=', $id)->first());

        // print by pdd
        $pdf = Pdf::loadView('pdf.results_overall', compact([
            'Judges',
            'TotalsMale',
            'TotalsFemale',
            'Scores',
            'Categories',
            'CandidatesMale',
            'CandidatesFemale',
        ]))->setPaper('a4', 'landscape');
        // download the pdf
        $pdf->setOption(['orientation' => "landscape"]);
        // then stream it
        return $pdf->stream();
    }

    public function backup_database()
    {
        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";
        $tables             = array("users", "candidates", "categories", "criterias", "scores", "candidate_category_lists"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach ($show_table_result as $show_table_row) {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }
}
