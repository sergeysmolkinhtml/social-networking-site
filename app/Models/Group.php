<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $table = 'group';

    public function setGroupNameAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }
}
