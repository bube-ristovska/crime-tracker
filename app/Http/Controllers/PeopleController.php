<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeopleController extends Controller
{
    function filter(){
        return view('filter');
    }
}
