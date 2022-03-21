<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

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

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id', 'id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'conflict_id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(ConflictHistory::class, 'conflict_id');
    }

    public function scopeUsersConflicts($query)
    {
        return $query->where('plaintiff_id', '=', Auth::user()->id);
    }

    public function conflictOrders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
