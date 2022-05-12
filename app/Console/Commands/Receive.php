<?php declare(strict_types=1);

namespace App\Console\Commands;

use App\Http\Service\RabbitMQ\RabbitReceiver;
use Illuminate\Console\Command;

class Receive extends Command
{
    protected $signature = 'messages:receive';

    protected $description = 'Receive messages from the queue';

    protected RabbitReceiver $receiver;

    public function __construct(RabbitReceiver $receiver)
    {
        parent::__construct();
        $this->receiver = $receiver;
    }

    public function handle()
    {
        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $this->receiver->receive();

        return 0;
    }
}
