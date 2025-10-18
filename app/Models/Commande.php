<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'commandNumber',
        'client_id',
        'car_model_id',
        'status',
        'totalPrice',
        'deposit',
        'remainingAmount',
        'paymentStatus',
        'comments',
        'container_id',
        'deliveredAt',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }
}
