<?php

namespace App\Models;

use Database\Factories\CremeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Creme extends Model
{
    /** @use HasFactory<CremeFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderCremeItem::class);
    }
}
