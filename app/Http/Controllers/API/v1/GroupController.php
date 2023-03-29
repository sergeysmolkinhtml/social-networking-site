<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController
{
    public function __construct()
    {
        request()->headers->set('Accept','application/json');
    }


    public function index(): AnonymousResourceCollection
    {
        if(! auth()->user()->tokenCan('title-list')){
            abort(403,'unauthorized');
        }
        return GroupResource::collection(Group::all());
    }

    public function show($id)
    {
        if(! auth()->user()->tokenCan('title-list')){
            abort(403,'unauthorized');
        }

        return GroupResource::collection(Group::all()->where('id',$id))->first();
    }
}
