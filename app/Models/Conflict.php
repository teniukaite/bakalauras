<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conflict extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Conflict::class, 'parent_id', 'id');
    }

    public function plaintiff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'plaintiff_id', 'id');
    }

    public function defendant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'defendant_id', 'id');
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id', 'id');
    }
}
