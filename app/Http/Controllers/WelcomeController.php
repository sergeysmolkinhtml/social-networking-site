<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class WelcomeController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $data  = [];

        return inertia('Welcome/Index',compact('data'));
    }

}
