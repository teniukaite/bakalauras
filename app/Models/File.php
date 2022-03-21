<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function conflict(): BelongsTo
    {
        return $this->belongsTo(Conflict::class, 'conflict_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'file_id');
    }
}
