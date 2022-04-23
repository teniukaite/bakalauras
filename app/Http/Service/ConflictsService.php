<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Models\Token;

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

    public function checkToken(string $token): array
    {
        $message = [];
        $tokenFromDb = Token::where('token', $token)->first();
        $message = [
            'message' => null,
        ];

        if (!$tokenFromDb) {
            $message['message'] = 'Jūs neturite teisės pasiekti šio puslapio';
        }

        if ($tokenFromDb->users->id !== auth()->user()->id) {
            $message['message'] = 'Jūs neturite teisės pasiekti šio puslapio';
        }

        if($tokenFromDb->is_expired) {
            $message['message'] = 'Jūs neturite teisės pasiekti šio puslapio';
        }

        if (date_diff(now(), $tokenFromDb->created_at)->days > 3){
            $tokenFromDb->is_expired = true;
            $tokenFromDb->save();
            $message['message'] = 'Jūs neturite teisės pasiekti šio puslapio';
        }

        $conflict = $tokenFromDb->conflicts;
        $message['conflict'] = $conflict;

        return $message;
    }
}
