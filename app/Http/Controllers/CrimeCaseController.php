<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CrimeCaseController extends Controller
{
    function cases(){

        $police_station= DB::select('select * from police_station where pe_id=:pe_id;',['pe_id'=> Session::get('pe_id')]);
        $cases = DB::select('select * from crime_case where p_id=:p_id;',['p_id'=> $police_station[0]->p_id]);

        return view('cases', [
            'cases' => $cases
        ]);

    }
    function case(){
        return view('case');
    }
}
