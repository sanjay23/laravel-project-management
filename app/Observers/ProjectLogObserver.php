<?php

namespace App\Observers;

use App\Models\ProjectLog;

class ProjectLogObserver
{
    /**
     * Handle the ProjectLog "created" event.
     */
    public function created(ProjectLog $projectLog): void
    {
        //
    }

    /**
     * Handle the ProjectLog "updated" event.
     */
    public function updated(ProjectLog $projectLog): void
    {
        //
    }

    /**
     * Handle the ProjectLog "deleted" event.
     */
    public function deleted(ProjectLog $projectLog): void
    {
        //
    }

    /**
     * Handle the ProjectLog "restored" event.
     */
    public function restored(ProjectLog $projectLog): void
    {
        //
    }

    /**
     * Handle the ProjectLog "force deleted" event.
     */
    public function forceDeleted(ProjectLog $projectLog): void
    {
        //
    }
}
