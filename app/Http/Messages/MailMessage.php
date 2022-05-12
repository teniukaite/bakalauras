<?php declare(strict_types=1);

namespace App\Http\Messages;

use App\Http\Interfaces\MailMessageInterface;
use App\Http\Interfaces\QueueMessageInterface;
use Illuminate\Support\Facades\Mail;

class MailMessage implements QueueMessageInterface
{
    protected MailMessageInterface $message;
    protected string $receiver;

    public function __construct(MailMessageInterface $message, string $receiver)
    {
        $this->message = $message;
        $this->receiver = $receiver;
    }

    public function send(): void
    {
        Mail::to($this->receiver)->send($this->message);
    }
}
