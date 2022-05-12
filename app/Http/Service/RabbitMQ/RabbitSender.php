<?php

declare(strict_types=1);

namespace App\Http\Service\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitSender
{
    private RabbitService $rabbit;

    public function __construct(RabbitService $rabbit)
    {
        $this->rabbit = $rabbit;
    }

    public function send(object $message): void
    {
        $channel = $this->rabbit->channel();
        $msg = new AMQPMessage(serialize($message));
        $channel->basic_publish($msg, '', 'queue');
        $channel->close();
    }

    public function close(): void
    {
        $this->rabbit->close();
    }
}
