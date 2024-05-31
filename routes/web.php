<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// login routes
Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/loginUser', [AuthenticationController::class, 'login_user']);

// admin routes
// Route::get('/AdminLogin', function () {
//     return view('authentication.adminLogin');
// })->name('login');

// Route::post('/loginAdmin', [AuthenticationController::class, 'login_admin']);

// authenticated users can access this routes
Route::middleware('auth')->group(function () {

    Route::middleware('user.type:ADMIN')->group(function () {
        // administrator management
        Route::resource('candidate', CandidateController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('criteria', CriteriaController::class);
        Route::any('/remove_criteria/{id}', [CriteriaController::class, 'destroy_criteria'])->name('remove_criteria');
        Route::get('/showResults', [ResultController::class, 'results']);

        Route::get('/showJudgesResults/{id}', [JudgeController::class, 'show_judges_scores'])->name('showJudgesResults');

        // printables
        Route::get('/printResults', [ResultController::class, 'printable_results']);
        Route::get('/printJudgeScores/{id}', [ResultController::class, 'printable_judge_scores'])->name('printJudgeScores');

        // user management (part of the admin manage)
        Route::resource('user', UserController::class);

        // database backup
        Route::get('/DatabaseBackup', [ResultController::class, 'backup_database'])->name('DatabaseBackup');
    });

    Route::middleware('user.type:ADMIN,JUDGE')->group(function () {
        // judges access
        Route::get('/home', function() {
            return view('judge.home');
        });
        Route::get('/scoreCandidate/{category_id}', [CandidateController::class, 'score_candidate'])->name('scoreCandidate');
        Route::post('/submitScoreCandidate', [CandidateController::class, 'record_score_candidate']);
    });

    // Route::resource('judge', JudgeController::class);
    // Route::get('/judgeScores/{id}', [JudgeController::class, 'show_judge_scores'])->name('judgeScores');
    // Route::get('/candidateScores/{id}', [CandidateController::class, 'show_candidates_scores'])->name('candidateScores');
    // Route::get('/results', [ResultController::class, 'show_total_results']);

    // // pdf routes data
    // Route::any('/judgeScoresPDF/{id}', [JudgeController::class, 'print_pdf_judge_scores'])->name('judgeScoresPDF');
    // Route::any('/candidatesScoresPDF/{id}', [CandidateController::class, 'print_candidates_scores'])->name('candidatesScoresPDF');
    // Route::any('/scoresResultsPDF', [ResultController::class, 'print_pdf_total_scores'])->name('scoresResultsPDF');

    // logout
    Route::delete('/logoutUser', [AuthenticationController::class, 'logout_user']);
});


// judge routes
// Route::get('/JudgeLogin', function () {
//     return view('authentication.judgeLogin');
// });

// Route::post('/loginJudge', [AuthenticationController::class, 'login_judge']);

// Route::middleware('authJudge')->group(function () {
//     // judge logout
//     Route::delete('/logoutJudge', [AuthenticationController::class, 'logout_judge']);

//     // score candidates
//     // Route::get('/scoringContetant', function () {
//     //     return view('judge.scoring');
//     // });

//     // score by category
//     Route::get('/scoreByCategory/{category}', [JudgeController::class, 'score_candidates_by_category'])->name('scoreByCategory');

//     // score top 3
//     Route::get('/Top3/{category}', [JudgeController::class, 'score_top3_candidates'])->name('Top3');

//     // submit the scores
//     Route::post('/submitCandidatesScores', [JudgeController::class, 'submit_candidates_scores'])->name('submitCandidatesScores');
// });

// user management
// Route::resource('user', UserController::class);