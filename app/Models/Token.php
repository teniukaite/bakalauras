<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Token extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function conflicts(): BelongsTo
    {
        return $this->belongsTo(Conflict::class, 'conflict_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
