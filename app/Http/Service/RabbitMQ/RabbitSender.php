<?php

declare(strict_types=1);

namespace App\Http\Service\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitSender
{
    private RabbitService $rabbit;
    private AMQPChannel $channel;

    public function __construct(RabbitService $rabbit)
    {
        $this->rabbit = $rabbit;
    }

    public function send(Message $message): void
    {
        $this->channel = $this->rabbit->channel();
        $msg = new AMQPMessage(serialize($message));
        $this->channel->basic_publish($msg, '', 'queue');
        $this->channel->close();
    }

    public function close(): void
    {
        $this->rabbit->close();
    }
}
