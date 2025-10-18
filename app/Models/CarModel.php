<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'transmission',
        'fuelType',
        'engine',
        'mileage',
        'price',
        'features',
        'images',
        'isAvailable',
        'location',
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'car_model_feature');
    }
}