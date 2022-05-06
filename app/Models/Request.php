<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asker(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'askedBy_id');
    }

    public function answerer(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'answeredBy_id');
    }
}
