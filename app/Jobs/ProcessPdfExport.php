<?php

namespace App\Jobs;

use App\Events\ExportPdfStatusUpdated;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessPdfExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new ExportPdfStatusUpdated($this->user,[
            'message' => 'Exporting...',
        ]));

        $pdf = PDF::loadView('pdf.users',['users' => User::all()]);

        Storage::put('public/users.pdf',$pdf->output());

        event(new ExportPdfStatusUpdated($this->user,[
            'message' => 'Complete!',
            'link'    => Storage::disk('public')->url('users.pdf')
        ]));
    }
}
