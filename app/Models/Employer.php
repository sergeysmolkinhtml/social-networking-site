<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table = 'employers';

    protected $fillable = [
        'who_finding',
        'candidate_sphere',
        'vacancy_description',
        'city',
        'languages',
        'linkedin_page',
        'user_id',
    ];


    public function user()
    {
        $this->hasOne(User::class);
    }

    public function vacancies()
    {
        $this->hasMany(Vacancy::class);
    }



}
