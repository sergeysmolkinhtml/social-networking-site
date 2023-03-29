<?php

namespace App\Models;

use App\Models\Scopes\Filter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Group extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        Filter,
        SoftDeletes;



    public const STATUS = ['open', 'in progress', 'pending', 'waiting client', 'blocked', 'closed'];

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'group';

    protected $appends = [
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setGroupNameAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

}
