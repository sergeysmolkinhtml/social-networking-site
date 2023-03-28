<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::paginate(20);
        dd(__METHOD__);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('groups.edit',compact('group'));
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
    public function destroy(Group $group): RedirectResponse
    {
        abort_if(Gate::denies('delete'),Response::HTTP_FORBIDDEN,'403 Forbidden');

        try {
            $group->delete();
        } catch (QueryException $exception){
            if($exception->getCode() == '23000'){
                return redirect()->back()->with('status', 'Group belongs to project.Cannot delete');
            }
        }
        return redirect()->route('groups.index');
    }
}
