<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
      'name',
      'price',
      'slug',
      'image',
      'is_active',

    ];

    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
