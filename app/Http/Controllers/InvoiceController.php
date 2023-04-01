<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InvoiceController
{

    public function store(Request $request): void
    {
        if ($request->hasFile('invoice')) {
            $file = $request->file('invoice');
            $file->storeAs('invoices', $file->getClientOriginalName(), 's3');
        }

    }

    public function uploadCat()
    {

        $url = Storage::disk('s3')->url('images/cat.jpg');

        $urls = collect(Storage::disk('s3')->allFiles())->map(function ($key) {
            return [
                'key' => $key,
                'url' => Storage::disk('s3')->url($key),
            ];
        });

        dd($urls);
        Storage::disk('s3')->put($key, $contents);

    }

    public function show(string $name): StreamedResponse
    {
        $canDownload = true;

        if (! $canDownload) {
            abort(403);
        }

        $disk = Storage::disk('s3');
        $key  = 'invoices/' . $name;

        if (! $disk->fileExists($key)) {
            abort(404);
        }

        return $disk->download($key);
    }

}
