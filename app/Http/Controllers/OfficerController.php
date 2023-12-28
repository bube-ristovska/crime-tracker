<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficerController extends Controller
{
    function employees()
    {
        return view('employees');
    }
}
