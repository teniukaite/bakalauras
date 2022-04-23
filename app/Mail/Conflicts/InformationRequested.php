<?php

declare(strict_types=1);

namespace App\Mail\Conflicts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformationRequested extends Mailable
{
    use Queueable, SerializesModels;

    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.conflicts.informationRequested')
            ->subject('Prašome pateikti papildomą informaciją')
            ->with([
                'url' => $this->url,
            ]);
    }
}
