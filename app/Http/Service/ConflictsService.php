<?php

declare(strict_types=1);

namespace App\Http\Service;

class ConflictsService
{
    public static function getCause(int $causeId): string
    {
        return match ($causeId) {
            1 => 'Nekokybiškas darbas',
            2 => 'Nesumokėti pinigai',
            3 => 'Neatliktas darbas',
            4 => 'Neadekvatus bendravimas',
            5 => 'Vagystė',
        };
    }

    public static function getStatus(int $statusId): string
    {
        return match ($statusId) {
            0 => 'Pateiktas',
            1 => 'Peržiūrėtas',
            2 => 'Laukiama informacijos',
            3 => 'Priimamas sprendimas',
            4 => 'Išspręstas',
            5 => 'Atšauktas',
            6 => 'Grąžintas',
        };
    }
}
