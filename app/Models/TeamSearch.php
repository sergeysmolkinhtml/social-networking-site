<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamSearch extends Model
{
    use HasFactory;

    protected $table = 'team_search';

    protected $fillable = [
        'search_for',
        'short_description',
        'long_description',
        'stack_of_technologies',
        'user_grade',
        'accept_with_grade',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Carbon::createFromFormat('m/d/Y',$value)
                ->format('Y-m-d')
        );
    }

}
