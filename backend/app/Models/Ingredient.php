<?php

namespace App\Models;

use Database\Factories\IngredientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    /** @use HasFactory<IngredientFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria', // creme, recheio, acompanhamento, cobertura
    ];

    public function items(): HasMany // N:1
    {
        return $this->hasMany(OrderIngredientItem::class);
    }
}
