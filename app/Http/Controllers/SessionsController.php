<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SessionsController extends Controller
{
    public function store()
    {

        $credentials = request()->validate([
            'badge_no' => 'required',
            'password' => 'required'
        ]);
        $password = $credentials['password'];
        $badge_no = $credentials['badge_no'];
        $policeman = true;
        $exists = DB::select('select * from policeman where badge_no = :badge_no;', ['badge_no' => $badge_no]);
        $pass = DB::select('select p_password from policeman where badge_no = :badge_no;', ['badge_no' => $badge_no]);
        if($exists == null) {
            $exists = DB::select('select * from officer where o_badge_no = :badge_no;', ['badge_no' => $badge_no]);
            $pass = DB::select('select o_password from officer where o_badge_no = :badge_no;', ['badge_no' => $badge_no]);
            $policeman = false;
        }
        if($exists == null) {
            return back()->withErrors(['badge_no' => 'Invalid credentials']);
        }

        foreach ($pass[0] as $key => $val) {
            $value = $val;
            break; // Break after the first key-value pair
        }


        if ($value == $password) {
            // Authentication passed
            Session::put('badge_no', $badge_no);
            Session::put('is_policeman', $policeman);
            return redirect()->intended('/');
        }

        // Authentication failed
        return back()->withErrors(['password' => 'Invalid credentials']);
    }

    public function logout()
    {
        Session::forget('badge_no');
        Session::forget('is_policeman');
        return redirect('/login');
    }
}
