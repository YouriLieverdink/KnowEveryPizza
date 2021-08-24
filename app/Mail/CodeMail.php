<?php

namespace App\Mail;

use App\Models\Code;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The code instance.
     * 
     * @var App\Models\Code
     */
    public $code;

    /**
     * Whether the code is a credential.
     * 
     * @var boolean
     */
    public $isCredential;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Code $code, bool $isCredential = true)
    {
        $this->code = $code;
        $this->isCredential = $isCredential;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->isCredential ? 'Login requested' : 'You have been invited';

        return $this->view('mail.code')->subject($subject);
    }
}
