<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\Credential;
use App\Events\CodeCreatingEvent;

class UpdateExpiresAt
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CodeCreatingEvent $event)
    {
        $now = Carbon::now();

        // Check whether the type of the code is credential.
        if ($event->code instanceof Credential) {

            $now->addSecond(15);
        } //
        else {

            $now->addWeeks();
        }

        // Update the model with the expiration date.
        $event->code->forceFill(['expires_at' => $now->toDateTimeString()]);
    }
}
