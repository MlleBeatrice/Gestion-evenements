<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'description', 'location',
        'event_date', 'capacity', 'image',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    // Places restantes = capacité - nombre d'inscriptions
    public function getRemainingSeatsAttribute(): int
    {
        $count = $this->registrations_count ?? $this->registrations()->count();

        return max(0, $this->capacity - $count);
    }

    public function isFull(): bool
    {
        return $this->remaining_seats === 0;
    }

    // Recherche par mot-clé dans le titre, la description et le lieu
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function (Builder $q) use ($term) {
            $q->where(function (Builder $w) use ($term) {
                $w->where('title', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('location', 'like', "%{$term}%");
            });
        });
    }

    // Filtre par catégorie (via son slug)
    public function scopeInCategory(Builder $query, ?string $slug): Builder
    {
        return $query->when($slug, function (Builder $q) use ($slug) {
            $q->whereHas('category', fn (Builder $c) => $c->where('slug', $slug));
        });
    }

    // Filtre par jour précis
    public function scopeOnDate(Builder $query, string $date): Builder
    {
        return $query->whereDate('event_date', $date);
    }

    // Événements à venir
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('event_date', '>=', now());
    }
}