<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Inertia\ResponseFactory;


class GroupsController extends Controller
{

    public function index(): \Inertia\Response|ResponseFactory
    {
        $this->authorize('viewAny', Group::class);
        $groups = GroupResource::collection(Group::all());

        return inertia('Groups/Index', compact('groups'));
    }


    public function create(): \Inertia\Response|ResponseFactory
    {
        $this->authorize('create', Group::class);
        return inertia('Groups/Create');
    }

    public function store(StoreGroupRequest $request): RedirectResponse
    {

        $this->authorize('create', Group::class);
        Group::create($request->validated());

        return redirect()->route('group.index')
            ->with('message', 'Group created successfully');
    }

    public function edit(Group $group): \Inertia\Response|ResponseFactory
    {
        $this->authorize('create', Group::class);
        return inertia('Group/Edit', compact('group'));
    }

    public function update(Group $group, StoreGroupRequest $request)
    {
        $this->authorize('create', Group::class);
        $group->update($request->validated());

        return redirect()->route('groups.index')
            ->with('message', 'Group updated successfully');
    }

    public function destroy(Group $group): RedirectResponse
    {
        $this->authorize('create', Group::class);

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
