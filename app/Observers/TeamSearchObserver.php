<?php

namespace App\Observers;

use App\Models\TeamSearch;
use Carbon\Carbon;

class TeamSearchObserver
{

    public function creating(TeamSearch $teamSearch): void
    {
        $teamSearch->created_at = Carbon::createFromFormat('m/d/Y',$teamSearch->created_at)
            ->format('Y-m-d');
    }

    /**
     * Handle the TeamSearch "created" event.
     */
    public function created(TeamSearch $teamSearch): void
    {
        //
    }

    /**
     * Handle the TeamSearch "updated" event.
     */
    public function updated(TeamSearch $teamSearch): void
    {
        //
    }

    /**
     * Handle the TeamSearch "deleted" event.
     */
    public function deleted(TeamSearch $teamSearch): void
    {
        //
    }

    /**
     * Handle the TeamSearch "restored" event.
     */
    public function restored(TeamSearch $teamSearch): void
    {
        //
    }

    /**
     * Handle the TeamSearch "force deleted" event.
     */
    public function forceDeleted(TeamSearch $teamSearch): void
    {
        //
    }
}
