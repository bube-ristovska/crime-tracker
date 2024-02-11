<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PeopleController extends Controller
{
    function filter(){
        if(Session::get('pe_id') == null) {
            return view('login');
        }
        $peoples = DB::select('select * from people;');

        return view('filter', [
            'peoples' => $peoples
        ]);
    }
    function filter_post(){
        if(Session::get('pe_id') == null) {
            return view('login');
        }
        $credentials = request()->validate([
            'embg' => 'required'
        ]);
        $embg = $credentials['embg'];

        $peoples = DB::select('SELECT * FROM people WHERE embg ~ :embg', ['embg' =>  '^' . $embg]);

        return view('filter', [
            'peoples' => $peoples
        ]);
    }
    public function getPerson(Request $request)
    {
        $embg = $request->input('embg');
        $person = DB::select('SELECT * FROM people WHERE embg = :embg', ['embg' => $embg]);

        return response()->json($person[0] ?? null);
    }
}
