<?php

namespace App\Observers;

use App\KpaApplication;
use App\Notifications\NewApplicationNotification;
use App\Notifications\SentForAnalysisNotification;
use App\Notifications\StatusChangeNotification;
use App\Notifications\SubmittedAnalysisNotification;
use App\Role;
use App\Status;
use Illuminate\Support\Facades\Notification;

class KpaApplicationObserver
{
    /**
     * Handle the kpa application "creating" event.
     *
     * @param  \App\kpaApplication  $kpaApplication
     * @return void
     */
    public function creating(KpaApplication $kpaApplication)
    {
        $processingStatus = Status::whereName('Processing')->first();

        $kpaApplication->status()->associate($processingStatus);
    }

    /**
     * Handle the kpa application "created" event.
     *
     * @param  \App\KpaApplication  $kpaApplication
     * @return void
     */
    public function created(KpaApplication $kpaApplication)
    {
        $admins = Role::find(1)->users;

        // Notification::send($admins, new NewApplicationNotification($kpaApplication));
    }

    /**
     * Handle the kpa application "updated" event.
     *
     * @param  \App\KpaApplication  $kpaApplication
     * @return void
     */
    public function updated(KpaApplication $kpaApplication)
    {
        if ($kpaApplication->isDirty('status_id')) {
            if (in_array($kpaApplication->status_id, [2, 5])) {
                if ($kpaApplication->status_id == 2) {
                    $user = $kpaApplication->analyst;
                } else {
                    $user = $kpaApplication->cfo;
                }

                Notification::send($user, new SentForAnalysisNotification($kpaApplication));
            } elseif (in_array($kpaApplication->status_id, [3, 4, 6, 7])) {
                $users = Role::find(1)->users;

                Notification::send($users, new SubmittedAnalysisNotification($kpaApplication));
            } elseif (in_array($kpaApplication->status_id, [8, 9])) {
                $kpaApplication->created_by->notify(new StatusChangeNotification($kpaApplication));
            }
        }
    }
}
