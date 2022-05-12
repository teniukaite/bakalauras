<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public static function getRole(int $roleID): string
    {
        return match ($roleID) {
            0 => 'Naudotojas',
            1 => 'Laisvai samdomas specialistas',
            2 => 'Moderatorius',
            3 => 'Administratorius',
        };
    }

    public static function getUnreadMessageCount(): int
    {
        return count(Message::where('receiver_id', '=', Auth::user()->id)->where('read', '=', false)->get());
    }

    public static function getUnreadMessages(): Collection
    {
        return Message::where('receiver_id', '=', Auth::user()->id)->where('read', '=', false)->get()->take(10);
    }

    public static function getAllMessages(): Collection
    {
        return Message::where('receiver_id', '=', Auth::user()->id)->get()->take(10);
    }

    public static function getReceivedMessageCount(): int
    {
        return count(Message::where('receiver_id', '=', Auth::user()->id)->get());
    }

    public static function getSentMessageCount(): int
    {
        return count(Message::where('sender_id', '=', Auth::user()->id)->get());
    }

    public static function getUserGender(int $genderID): string
    {
        return match ($genderID) {
            0 => 'Vyras',
            1 => 'Moteris',
        };
    }
}
