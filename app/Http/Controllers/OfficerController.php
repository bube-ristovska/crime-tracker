<?php

namespace App\Http\Controllers;

use App\Models\Policeman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    function employees()
    {
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
