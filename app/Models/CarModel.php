<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'year',
        'color',
        'transmission',
        'fuelType',
        'engine',
        'mileage',
        'price',
        'features',
        'isAvailable',
        'location',
    ];

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    protected $casts = [
        'features' => 'array',
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'car_model_feature');
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarModelImage::class)->orderBy('order');
    }

}