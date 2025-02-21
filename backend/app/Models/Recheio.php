<?php

namespace App\Models;

use Database\Factories\RecheioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recheio extends Model
{
    /** @use HasFactory<RecheioFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
