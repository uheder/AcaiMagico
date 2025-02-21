<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cobertura extends Model
{
    /** @use HasFactory<\Database\Factories\CoberturaFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderCoberturaItem::class);
    }
}
