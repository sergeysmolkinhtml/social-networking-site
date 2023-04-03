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
        //data comes from eloquent into the web controller and then to inertia
        return inertia('Welcome/Index',compact('data'));
    }

}
