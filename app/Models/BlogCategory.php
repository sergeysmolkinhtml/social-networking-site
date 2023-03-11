<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    const ROOT = 1;

    protected $fillable = [
            'title',
            'slug',
            'parent_id',
            'description'
        ];

    /**
     * @return BelongsTo
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class,'parent_id','id');
    }


    public function getParentTitleAttribute()
    {
        #TODO
        $title = $this->parentCategory()->getParent() ?? ($this->isRoot() ? 'Root' : '???');

        return $title;
    }

    public function isRoot(): bool
    {
        return $this->id === BlogCategory::ROOT;
    }

    /**
     * @param $valueFromObject
     * @return array|false|string|string[]|null
     */
    public function getTitleAttribute($valueFromObject)
    {
        return mb_strtoupper($valueFromObject);
    }

    /**
     * @param $incomingValue
     * @return void
     */
    public function setTitleAttribute($incomingValue)
    {
        $this->attributes['title'] = mb_strtolower($incomingValue);
    }
}
