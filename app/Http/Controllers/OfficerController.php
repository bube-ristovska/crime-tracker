<?php

namespace App\Http\Controllers;

use App\Models\Policeman;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
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


}
