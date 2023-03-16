<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function results(Request $request)
    {
        $query = $request->input('query');
        if (!$query){
            redirect()->route('/');
        }

        $users = User::where(DB::raw("CONCAT (name, ' ' ,last_name)"), 'LIKE', "%$query")
                                                ->orWhere('nickname','LIKE',"%$query%")->get();


        return view('search.result',compact('users'));
    }
}
