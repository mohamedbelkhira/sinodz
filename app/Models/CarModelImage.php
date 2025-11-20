<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarModelImage extends Model
{
    protected $fillable = ['car_model_id', 'image', 'order'];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }
}