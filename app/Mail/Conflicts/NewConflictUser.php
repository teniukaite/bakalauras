<?php

declare(strict_types=1);

namespace App\Mail\Conflicts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\View\View;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewConflictUser extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build():NewConflictUser
    {
        return $this->view('mails.conflicts.newConflictUser');
    }
}
