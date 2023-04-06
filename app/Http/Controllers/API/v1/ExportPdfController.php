<?php

namespace App\Http\Controllers\API\v1;

use App\Events\ExportPdfStatusUpdated;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessPdfExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExportPdfController extends Controller
{
    public function __invoke(Request $request): Response
    {
        event(new ExportPdfStatusUpdated($request->user(), [
            'message' => 'Queuing...',
        ]));

        ProcessPdfExport::dispatch($request->user());

        return response()->noContent();
    }
}
