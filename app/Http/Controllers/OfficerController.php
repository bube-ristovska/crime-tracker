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
    private function policeStationIsPoliceman()
    {
        return DB::table('police_station')
            ->where('p_id', Session::get('p_id'))
            ->get();
    }
    private function policeStationIsOfficer()
    {
       return DB::table('police_station')
           ->where('pe_id', Session::get('pe_id'))
           ->get();
    }
    function employees()
    {
        if(Session::get('pe_id') == null) {
            return view('login');
        }
        if(Session::get('is_policeman')){
            $police_station = $this->policeStationIsPoliceman();
        } else {
            $police_station = $this->policeStationIsOfficer();
        }
        $results = DB::table('policeman')
            ->join('people', 'policeman.pe_id', '=', 'people.pe_id')
            ->where('policeman.p_id', $police_station[0]->p_id)
            ->get();


        return view('employees', [
            'employees' => $results,
            'p_address'=>$police_station[0]->p_address
        ]);
    }

    function show($id){
        if(Session::get('is_policeman')){
            $police_station = $this->policeStationIsPoliceman();
        } else {
            $police_station = $this->policeStationIsOfficer();
        }
        $result = DB::table('policeman')
            ->join('people', 'policeman.pe_id', '=', 'people.pe_id')
            ->where('p_id', $police_station[0]->p_id)
            ->where('people.pe_id', $id)
            ->get();
        $cases = DB::table('statements')
            ->where('pe_id', $id)
            ->get();
        return view('employee', [
            'employee' => $result[0],
            'p_address'=>$police_station[0]->p_address,
            'cases' => $cases
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


        $police_station = $this->policeStationIsOfficer();
        $pe_id = DB::table('people')
            ->where('embg', $policeman['embg'])->get();
        $data = [
            'pe_id' => $pe_id[0]->pe_id,
            'badge_no' => $policeman["badge_no"],
            'p_date_of_employment' => Carbon::now()->format('Y-m-d'),
            'rank' => $policeman["rank"],
            'p_id' => $police_station[0]->p_id,
            'p_password' => $policeman["password"]
        ];
        DB::table('policeman')->insert($data);
//        DB::insert('INSERT INTO policeman (pe_id, badge_no, p_date_of_employment, rank, p_id, p_password) VALUES (?, ?, ?, ?, ?, ?)', [$pe_id[0]->pe_id, $policeman["badge_no"], Carbon::now()->format('Y-m-d'), $policeman["rank"], $police_station[0]->p_id,$policeman["password"]]);
        return redirect()->back()->with('message',"Додадено");
    }




}
