<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $role = request()->input('role');


        $statement = request()->validate([
            'embg' => 'required',
            'description' => 'required',
            'incident_timestamp' => 'required',
            'incident_place'=>'required'
        ]);
        $statement["statement_date"] = Carbon::now()->format('Y-m-d');
        $covek = DB::select('select pe_id from people where embg=:embg;',['embg'=> $statement["embg"]]);
         $s_id_b = DB::select('select MAX(s_id) from statements');
         $s_id = $s_id_b[0]->max;
        $s_id = $s_id +1 ;
        $policaec =  DB::select('select pe_id from policeman where badge_no=:badge_no;',['badge_no'=> Session::get("badge_no")]);

        if ($role === 'witness') {
            DB::insert('INSERT INTO statements (s_id, statement_date, description, incident_timestamp, incident_place, c_id, pe_id, victim_pe_id, witness_pe_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $s_id,
                    $statement["statement_date"],
                    $statement["description"],
                    $statement["incident_timestamp"],
                    $statement["incident_place"],
                    Session::get("c_id"),
                    $policaec[0]->pe_id,
                    NULL,
                    $covek[0]->pe_id

                ]);
        } elseif ($role === 'victim') {
            DB::insert('INSERT INTO statements (s_id, statement_date, description, incident_timestamp, incident_place, c_id, pe_id, victim_pe_id, witness_pe_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $s_id,
                    $statement["statement_date"],
                    $statement["description"],
                    $statement["incident_timestamp"],
                    $statement["incident_place"],
                    Session::get("c_id"),
                    $policaec[0]->pe_id,
                    $covek[0]->pe_id,
                    NULL
                ]);
        }
        return redirect()->route('case', ['wildcard' =>  Session::get("c_id"),]);


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
        Session::put('c_id', $wildcard);
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
            if (!($st->victim_pe_id)==NULL){
                $victim=DB::select('select * from people where pe_id=:pe_id;',['pe_id'=> $st->victim_pe_id]);
                $victims[] = $victim[0];
            }
        }
        foreach ($statements as $st){
            if (!($st->witness_pe_id)==NULL) {
                $witnes = DB::select('select * from people where pe_id=:pe_id;', ['pe_id' => $st->witness_pe_id]);
                $witness[] = $witnes[0];
            }
        }


        return view('case', [
            'case' => $case[0],
            'p_address'=>$p_address[0]->p_address,
            'statements'=>$statements,
            'evidence'=>$evidence,
            'victims' => $victims,
            'witness' =>$witness
        ]);

    }
}
