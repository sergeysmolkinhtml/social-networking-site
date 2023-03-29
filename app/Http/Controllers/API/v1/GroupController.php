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
        return GroupResource::collection(Group::all());
    }

}
