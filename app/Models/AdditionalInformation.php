<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdditionalInformation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function person(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parentConflict(): BelongsTo
    {
        return $this->belongsTo(Conflict::class, 'conflict_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'additional_information_id');
    }
}
