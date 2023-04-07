<?php

namespace App\Http\Controllers\TeamSearch;

use App\Http\Controllers\Controller;
use App\Models\TeamSearch;
use Illuminate\Http\Request;

class TeamSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = TeamSearch::all();
        return view('teams-search.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams-search.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('teams-search.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('teams-search.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('teams-search.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd(__METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd(__METHOD__);
    }
}
