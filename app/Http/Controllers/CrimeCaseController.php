<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CrimeCaseController extends Controller
{
    function cases(){
        if(Session::get('pe_id') == null) {
            return view('login');
        }


        if(Session::get('is_policeman')){
            $police_station = DB::select('select * from police_station where p_id=:p_id;',['p_id'=>  Session::get('p_id')]);
        } else {
            $police_station = DB::select('select * from police_station where pe_id=:pe_id;',['pe_id'=>  Session::get('pe_id')]);
        }

        $cases = DB::select('select * from crime_case where p_id=:p_id;',['p_id'=> $police_station[0]->p_id]);


        return view('cases', [
            'cases' => $cases,
            'p_address'=>$police_station[0]->p_address
        ]);

    }
    function register_statement(){
        return view('register-statement');
    }
    function register_statement_post()
    {
       //TODO: so kiki i bojan vodete se po logikata na add policeman
    }
    function finished_cases(){

        if(Session::get('is_policeman')){
            $police_station = DB::select('select * from police_station where p_id=:p_id;',['p_id'=>  Session::get('p_id')]);
        } else {
            $police_station = DB::select('select * from police_station where pe_id=:pe_id;',['pe_id'=>  Session::get('pe_id')]);
        }

        $cases = DB::select('select * from crime_case where p_id=:p_id and c_status=\'Z\';', ['p_id' => $police_station[0]->p_id]);

        return view('archive', [
            'cases' => $cases,
            'p_address'=>$police_station[0]->p_address
        ]);
    }
    function case($wildcard){
        $case = DB::select('select * from crime_case where c_id=:c_id;',['c_id'=> $wildcard]);
        $p_address = DB::select('select p_address from police_station where p_id=:p_id;',['p_id'=> $case[0]->p_id]);
        $statements = DB::select('select * from statements where c_id=:c_id;',['c_id'=> $wildcard]);


        $victims=[];
        $witness=[];
        $evidence_id = [];
        $evidence = [];
        foreach ($statements as $statement) {
            $evidence_id = DB::select('select * from mentions_evidence where s_id=:s_id;',['s_id'=> $statement->s_id]);
            if (!empty($evidence_id)) { // Check if $evidence_id is not empty
                $evidence_id[] = $evidence_id[0];
            }
        }
         $evidence_id=collect($evidence_id)->unique();
        foreach ($evidence_id as $e) {
            $evidence = DB::select('select * from evidence where e_id=:e_id;',['e_id'=> $e->e_id]);
            $evidence[] = $evidence[0];
        }
        foreach ($statements as $st){
            $victim=DB::select('select * from people where pe_id=:pe_id;',['pe_id'=> $st->victim_pe_id]);
            $victims[] = $victim[0];
        }
        foreach ($statements as $st){
            $witnes=DB::select('select * from people where pe_id=:pe_id;',['pe_id'=> $st->witness_pe_id]);
            $witness[] = $witnes[0];
        }

        return view('case', [
            'case' => $case[0],
            'p_address'=>$p_address[0]->p_address,
            'statements'=>$statements,
            'evidence'=>$evidence,
            'victims'=> $victims,
            'witness'=> $witness
        ]);

    }
}
