<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastName',
        'type',
        'photo',
        'points',
        'email',
        'role',
        'gender',
        'birthday',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function submittedConflicts(): HasMany
    {
        return $this->hasMany(Conflict::class, 'plaintiff_id');
    }

    public function resolvedConflicts(): HasMany
    {
        return $this->hasMany(Conflict::class, 'moderator_id');
    }

    public function orderedOrders(): HasManyThrough
    {
        return $this->HasManyThrough(Order::class, User::class, 'id', 'client_id');
    }

    public function createdOrders(): HasManyThrough
    {
        return $this->HasManyThrough(Order::class, User::class, 'id', 'freelancer_id');
    }

    public function scopeRandomModerator($query, ?int $id = null)
    {
        if (!is_null($id)) {
            return $query->where('role', '=', 2)->where('id', '!=', $id)->inRandomOrder();
        }
        return $query->where('role', '=', 2)->inRandomOrder();
    }

    public function conflictHistory(): HasMany
    {
        return $this->hasMany(ConflictHistory::class, 'user_id');
    }

    public function fileComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class, 'user_id');
    }

    public function askedQuestions(): HasMany
    {
        return $this->hasMany(Request::class, 'askedBy_id');
    }

    public function answeredQuestions(): HasMany
    {
        return $this->hasMany(Request::class, 'answeredBy_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}
