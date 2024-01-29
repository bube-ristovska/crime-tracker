<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrimeCaseController extends Controller
{
    function cases(){
        return view('cases');
    }
    function case(){
        return view('case');
    }
}
