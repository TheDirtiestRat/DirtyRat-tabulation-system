<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function login () {
        return view('authentication.login');
    }

    public function login_user (Request $request) {
        // validate the request
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // authenticate user
        if (Auth::attempt($credentials)) {
            // check user types to log in to its proper homepage
            $url = "/candidate";
            if (Auth::user()->type == "JUDGE") {
                $url = "/home";
            } 
            // else if (Auth::user()->type == "RECEPTIONIST") {
            //     $url = "/dashboardReceptionist";
            // }
            
            // page to go to when successfully login
            return redirect($url);
        }

        // else failed
        return back()->with('error', 'Failed to login. (username or password is incorrect)');
    }

    public function logout_user () {
        // log out the user
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('info', 'user has logout.');
    }

    public function my_birthday(Request $request) {
        // if they guess my birthday go here
        $data = $request->all();
        
        if ($data['code'] == '03192001') {
            return view('pages.image-srp');
        }

        return back();
    }
    
    // public function login_admin_page()
    // {
    //     return view('authentication.adminLogin');
    // }

    // public function login_admin(Request $request)
    // {
    //     // validate the request
    //     $credentials = $request->validate([
    //         'email' => ['required'],
    //         'password' => ['required'],
    //     ]);

    //     // authenticate user
    //     if (Auth::attempt($credentials)) {
    //         // page to go to when successfully login
    //         return redirect('/candidate');
    //     }

    //     // else failed
    //     return back()->with('error', 'Failed to login. (username or password is incorrect)');
    // }

    // public function logout_admin()
    // {
    //     // log out the user
    //     Auth::logout();
    //     return redirect('/AdminLogin')->with('info', 'administrator has logout.');
    // }


    // // judge login functions
    // public function login_judge_page()
    // {
    //     return view('authentication.judgeLogin');
    // }

    // public function login_judge(Request $request)
    // {
    //     // validate the request
    //     $credentials = $request->validate([
    //         'judge_id' => ['required'],
    //     ]);

    //     // get the judge information
    //     $judge = Judge::query()->where('judge_id', '=', $credentials['judge_id'])->get('*');

    //     // dd($judge[0]);

    //     if ($judge) {
    //         // authenticate user
    //         session()->put('Judge_user', $judge);
    //         // page to go to when successfully login
    //         return redirect()->route('scoreByCategory', 0);
    //     }

    //     // else failed
    //     return back()->with('error', 'Failed to login. (no judge is listed with that ID.)');
    // }

    // public function logout_judge(Request $request)
    // {
    //     // log out the judge
    //     $request->session()->flush();
    //     session()->forget('Judge_user');

    //     return redirect('/JudgeLogin')->with('info', 'Judge has logout.');
    // }
}
