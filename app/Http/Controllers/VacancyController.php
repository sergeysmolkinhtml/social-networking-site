<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::all();
        return view('vacancies.show',
            [
                'vacancies' => $vacancies,
            ]
        );
    }
}
