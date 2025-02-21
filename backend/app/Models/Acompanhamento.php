<?php

namespace App\Models;

use Database\Factories\AcompanhamentoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Acompanhamento extends Model
{
    /** @use HasFactory<AcompanhamentoFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderAcompanhamentoItem::class);
    }
}
