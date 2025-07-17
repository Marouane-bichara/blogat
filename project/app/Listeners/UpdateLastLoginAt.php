<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\User;

class UpdateLastLoginAt
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        /** @var User $user */
        $user = $event->user;

        // Safer way to update last_login_at to avoid IDE issues
        $user->last_login_at = now();
        $user->save();
    }
}
