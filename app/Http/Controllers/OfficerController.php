<?php

namespace App\Http\Controllers;

use App\Models\Policeman;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfficerController extends Controller
{
    function employees()
    {
        if(Session::get('pe_id') == null) {
            return view('login');
        }
        $results = DB::select('select * from policeman join people on policeman.pe_id = people.pe_id;');
        return view('employees', [
            'employees' => $results
        ]);
    }

    function register()
    {
        return view('register-policeman');
    }
    function register_post()
    {
        $policeman = request()->validate([
            'badge_no' => 'required',
            'embg' => 'required',
            'password' => 'required',
            'rank'=>'required'
        ]);

        $pe_id = DB::select('select pe_id from people where embg = :embg;', ['embg' => $policeman["embg"]]);
        DB::insert('INSERT INTO policeman (pe_id, badge_no, p_date_of_employment, rank, p_id, p_password) VALUES (?, ?, ?, ?, ?, ?)', [$pe_id[0]->pe_id, $policeman["badge_no"], Carbon::now()->format('Y-m-d'), $policeman["rank"], $policeSTATION,$policeman["password"]]);
        return view('register-policeman');
    }


}
