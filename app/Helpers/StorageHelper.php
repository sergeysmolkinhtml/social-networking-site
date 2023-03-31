<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

class StorageHelper
{
    /**
     * Get a filesystem instance.
     *
     * @param  string  $name
     * @return FilesystemAdapter
     */
    public static function disk($name = null): FilesystemAdapter
    {
        /** @var FilesystemAdapter */
        $disk = Storage::disk($name);

        return $disk;
    }



}
