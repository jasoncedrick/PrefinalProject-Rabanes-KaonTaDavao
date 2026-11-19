<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eatery extends Model
{
    use HasFactory;

    protected $fillable = ['district_id', 'name', 'slug', 'address', 'price_range', 'specialty', 'is_open'];

    protected $casts = ['is_open' => 'boolean'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeForCards($query)
    {
        return $query->with(['district', 'features'])->withCount('reviews')->withAvg('reviews', 'rating');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function permit()
    {
        return $this->hasOne(Permit::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}
