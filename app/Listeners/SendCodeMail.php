<?php

namespace App\Listeners;

use App\Events\CodeCreatedEvent;
use App\Mail\CodeMail;
use App\Models\Credential;
use Illuminate\Support\Facades\Mail;

class SendCodeMail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CodeCreatedEvent $event)
    {
        // Whether the code is of type credential.
        $isCredential = $event->code instanceof Credential;

        // Create and send the mailable.
        $mailable = new CodeMail($event->code, $isCredential);
        Mail::to($event->code->email)->queue($mailable);
    }
}
