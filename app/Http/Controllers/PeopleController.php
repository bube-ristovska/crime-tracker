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
        $peoples = DB::table('people')->get();
        return view('filter', [
            'peoples' => $peoples
        ]);
    }
    function filter_post(){
        if(Session::get('pe_id') == null) {
            return view('login');
        }
//        $credentials = request()->validate([
//            'embg' => 'required'
//        ]);
//        $embg = $credentials['embg'];
//
//        $peoples = DB::select('SELECT * FROM people WHERE embg ~ :embg', ['embg' =>  '^' . $embg]);

        $credentials = request()->validate([
            'embg' => 'nullable', // Assuming embg is not always required
            'gender' => 'nullable',
            'age' => 'nullable',
        ]);
        $query = 'SELECT * FROM people WHERE true';

        $embg = '^' . $credentials['embg'];
        if ($credentials['embg']) {
            $query .= " AND embg LIKE '{$credentials['embg']}%'";
        }

        // Check if $credentials['gender'] is an array and handle accordingly
        if (isset($credentials['gender']) && (is_array($credentials['gender']) && count($credentials['gender']) > 0)) {
            $genderConditions = implode(" OR ", array_map(function ($gender) {
                return "gender = '{$gender}'";
            }, $credentials['gender']));

            $query .= " AND ({$genderConditions})";
        } elseif (isset($credentials['gender']) && !is_array($credentials['gender'])) {
            $query .= " AND gender = '{$credentials['gender']}'";
        }

        // Check if $credentials['age'] is an array and handle accordingly
        if (isset($credentials['age']) && is_array($credentials['age']) && count($credentials['age']) > 0) {
            $ageConditions = [];

            foreach ($credentials['age'] as $ageRange) {
                // Extract minimum and maximum ages from the range
                list($minAge, $maxAge) = explode('-', $ageRange);

                // Add condition for the age range
                $ageConditions[] = "EXTRACT(YEAR FROM AGE(current_date, date_of_birth)) BETWEEN {$minAge} AND {$maxAge}";
            }

            $query .= " AND (" . implode(" OR ", $ageConditions) . ")";
        }
        // Use a raw SQL query with the built conditions

        $peoples = DB::select($query);
        return view('filter', ['peoples' => $peoples]);
    }
    public function getPerson(Request $request)
    {
        $embg = $request->input('embg');
        $person = DB::table('people')
            ->where('embg', $embg)->get();
        return response()->json($person[0] ?? null);
    }
}
