<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissingProfileData extends Mailable
{
    use Queueable, SerializesModels;
    public $tutor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tutor)
    {
        $this->tutor = $tutor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.missingProfileData')
            ->with('tutor',$this->tutor);

    }
}
