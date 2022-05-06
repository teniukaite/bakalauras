<?php

declare(strict_types=1);

namespace App\Http\Service\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Exception\AMQPConnectionClosedException;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitReceiver
{
    private RabbitService $rabbit;
    private AMQPChannel $channel;
    private MessageService $messageService;
    private array $messages;

    public function __construct(RabbitService $rabbit, MessageService $messageService)
    {
        $this->rabbit = $rabbit;
        $this->messageService = $messageService;
        $this->channel = $this->rabbit->channel();
        $this->messages = [];
    }

    public function receive(): array
    {
        $this->channel->basic_consume('queue', '', false, true, false, false, [$this, 'processMessage']);
        while ($this->channel->is_consuming()) {
            try {
                $this->channel->wait(null, false, 10);
            } catch (AMQPTimeoutException $e) {
                $this->channel->close();
                $this->rabbit->close();
                return $this->messages;
            } catch (AMQPConnectionClosedException $e) {
                $this->rabbit->reconnect();
            }
        }

        return $this->messages;
    }

    public function processMessage(AMQPMessage $message): void
    {
        $this->messages[] = $this->messageService->send($message);
    }
}
