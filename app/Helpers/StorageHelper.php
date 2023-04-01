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
     * @param string|null $name
     * @return FilesystemAdapter
     */
    public static function disk(string $name = null): FilesystemAdapter
    {
        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk($name);

        return $disk;
    }



}
