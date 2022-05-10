<?php declare(strict_types=1);

namespace App\Http\Interfaces;

interface QueueMessageInterface
{
    public function send();
}
