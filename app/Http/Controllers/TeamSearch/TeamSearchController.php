<?php

namespace App\Http\Controllers\TeamSearch;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequst;
use App\Models\TeamSearch;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeamSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $teams = TeamSearch::all();
        return view('teams-search.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('teams-search.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequst $request): RedirectResponse
    {
        TeamSearch::create($request->validated());
        return redirect()->route('teams-search-index')->with(['msg' => 'Successfully created team']);
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
