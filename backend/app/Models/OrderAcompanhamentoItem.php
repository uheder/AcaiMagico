<?php

namespace App\Models;

use Database\Factories\OrderAcompanhamentoItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAcompanhamentoItem extends Model
{
    /** @use HasFactory<OrderAcompanhamentoItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'acompanhamento_id',
    ];
}
