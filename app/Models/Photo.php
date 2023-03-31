<?php

namespace App\Models;

use App\Helpers\StorageHelper;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $guarded = ['id'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class);
    }

    /**
     * Gets the full path of the photo.
     *
     * @return string
     */
    public function url(): string
    {
        if(config('filesystems.default_visibility' === 'public')){
            return asset(StorageHelper::disk(config('filesystems.default'))->url($this->new_filename));
        }

        return route('storage',['file' => $this->new_filename]);
    }

    /**
     * Gets the data-url format of the photo.
     *
     * @return string|null
     */
    public function dataUrl(): ?string
    {
        try {
            $url = $this->new_filename;
            $file = StorageHelper::disk(config('filesystems.default'))->get($url);

            return (string)Image::make($file)->encode('data-url');
        } catch (FileNotFoundException $e){
            return null;
        }
    }
    /**
     * Delete the model from the database.
     *
     * @return bool|null
     */
    public function delete(): ?bool
    {
        try {
            Storage::disk(config('filesystems.default'))
                ->delete($this->new_filename);
        } catch (FileNotFoundException $exception){
            // continue
        }

        return parent::delete();
    }
}
