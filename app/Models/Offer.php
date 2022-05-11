<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'offer_id');
    }

    public function scopeFreelancerOffers($query)
    {
        return $query->where('freelancer_id', '=', Auth::user()->id);
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'service_id', 'id');
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'offer_id');
    }
}
