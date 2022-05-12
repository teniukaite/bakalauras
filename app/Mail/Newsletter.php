<?php

namespace App\Mail;

use App\Http\Interfaces\MailMessageInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable implements MailMessageInterface
{
    use Queueable, SerializesModels;

    protected string $pdf;

    public function __construct(string $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newsletter')->attach(public_path().'/uploads/pdf/'.$this->pdf . '.pdf');
    }
}
