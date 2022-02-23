<?php

declare(strict_types=1);

namespace App\Mail\Conflicts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewConflict extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build(): NewConflict
    {
        return $this->view('mails.conflicts.newConflict');
    }
}
