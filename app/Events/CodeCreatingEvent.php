<?php

namespace App\Events;

use App\Models\Code;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CodeCreatingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The code instance.
     * 
     * @var \App\Models\Code
     */
    public $code;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Code $code)
    {
        $this->code = $code;
    }
}
