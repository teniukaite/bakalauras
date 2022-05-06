<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Http\Service\RabbitMQ\RabbitService;
use Illuminate\Console\Command;

class Receiver extends Command
{
    protected static $defaultName = 'messages:receive';
//    private RabbitService $rabbit;
//    private MessageService $messageService;
//
//    public function __construct(RabbitService $rabbit, MessageService $messageService)
//    {
//        $this->rabbit = $rabbit;
//        $this->messageService = $messageService;
//        parent::__construct();
//    }
//
//    protected function configure()
//    {
//        $this->setDescription('Gets all messages from the RabbitMQ queue');
//    }
//
//    protected function execute(InputInterface $input, OutputInterface $output): void
//    {
//        echo " [*] Waiting for messages. To exit press CTRL+C\n";
//
//        $receiver = new RabbitReceiver($this->rabbit, $this->messageService);
//        $receiver->receive();
//    }

}
