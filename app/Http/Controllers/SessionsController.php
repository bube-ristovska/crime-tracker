<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    function verifyPassword($inputPassword, $storedHash, $salt)
    {
        $hashedInputPassword = crypt($inputPassword . $salt, $storedHash);

        return $hashedInputPassword === $storedHash;
    }
    public function store()
    {
        $credentials = request()->validate([
            'badge_no' => 'required',
            'password' => 'required'
        ]);

        $password = $credentials['password'];
        $badge_no = $credentials['badge_no'];
        if (!is_numeric($badge_no)) {
            // Redirect back with an error message
            return back()->withErrors(['password' => 'Invalid credentials']);
        }
        // mozhe da se najavi kako policaec i kako officer, znaeme koj e koj po znachkata

        $policeman = true;
        $is_policeman = DB::select('select * from policeman where badge_no = :badge_no;', ['badge_no' => $badge_no]);
        $is_officer = DB::select('select * from officer where o_badge_no = :badge_no;', ['badge_no' => $badge_no]);
        if($is_officer==null && $is_policeman==null) {
            return back()->withErrors(['password' => 'Invalid credentials']);
        }
        if($is_officer!=null) {
            $pass = DB::select('select o_password from officer where o_badge_no = :o_badge_no;', ['o_badge_no' => $badge_no]);
            $salt = DB::select('select salt from officer where o_badge_no = :o_badge_no;', ['o_badge_no' => $badge_no]);
            $policeman = false;
        } else {
            $pass = DB::select('select p_password from policeman where badge_no = :badge_no;', ['badge_no' => $badge_no]);
            $salt = DB::select('select salt from policeman where badge_no = :badge_no;', ['badge_no' => $badge_no]);

        }

        foreach ($pass[0] as $key => $val) {
            $value = $val;
            break; // Break after the first key-value pair
        }
        foreach ($salt[0] as $key => $val) {
            $value2 = $val;
            break; // Break after the first key-value pair
        }
        if ($this->verifyPassword($password, $value, $value2)) {
            // Authentication passed
            Session::put('auth', true);
            Session::put('badge_no', $badge_no);
            Session::put('is_policeman', $policeman);
            if($policeman){
                Session::put('pe_id', $is_policeman[0]->pe_id);
                Session::put('p_id', $is_policeman[0]->p_id);
            } else {
                Session::put('pe_id', $is_officer[0]->pe_id);
            }
            return view('welcome');
        }

        // Authentication failed
        return back()->withErrors(['password' => 'Invalid credentials']);
    }
    public function logout()
    {
        Session::forget('badge_no');
        Session::forget('p_id');
        Session::forget('pe_id');
        Session::forget('is_policeman');
        return redirect('/login');
    }
}
