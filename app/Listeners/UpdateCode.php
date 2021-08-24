<?php

namespace App\Listeners;

use App\Events\Code\CodeCreatingEvent;

class UpdateCode
{
    /**
     * The vowels in the alphabet.
     * 
     * @var array
     */
    protected $vowels = ['a', 'e', 'i', 'o', 'u'];

    /**
     * The consonants in the alphabet.
     * 
     * @var array
     */
    protected $consonants = [
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z',
    ];

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CodeCreatingEvent $event)
    {
        $words = [];

        // Generate four random words.
        for ($i = 0; $i < 4; $i++) {
            array_push($words, $this->random_readable_string());
        }

        // Update the model with the code.
        $event->code->forceFill(['code' => join('-', $words)]);
    }

    /**
     * Return a random readable string.
     * 
     * @param string $length The length of the string.
     * @return string The generated random readable string.
     */
    public function random_readable_string($length = 4)
    {
        $value = '';

        $max = $length / 2;

        for ($i = 1; $i <= $max; $i++) {
            $value .= $this->consonants[rand(0, 19)];
            $value .= $this->vowels[rand(0, 4)];
        }

        return $value;
    }
}
