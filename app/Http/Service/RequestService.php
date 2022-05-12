<?php

declare(strict_types=1);

namespace App\Http\Service;

class RequestService
{
    public static function getStatus(int $code): string
    {
        return match ($code) {
            0 => 'Pateiktas',
            1 => 'Peržiūrėtas',
            2 => 'Atsakytas',
        };
    }
}
