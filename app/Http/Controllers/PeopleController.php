<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    function filter(){
        $peoples = DB::select('select * from people;');

        return view('filter', [
            'peoples' => $peoples
        ]);
    }
    function filter_post(){
        $credentials = request()->validate([
            'embg' => 'required'
        ]);
        $embg = $credentials['embg'];

        $peoples = DB::select('SELECT * FROM people WHERE embg ~ :embg', ['embg' =>  '^' . $embg]);

        return view('filter', [
            'peoples' => $peoples
        ]);
    }
}
