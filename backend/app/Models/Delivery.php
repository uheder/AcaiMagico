<?php

namespace App\Models;

use Database\Factories\DeliveryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    /** @use HasFactory<DeliveryFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'nome_cliente',
        'telefone_cliente',
        'rua',
        'numero',
        'bairro',
        'referencia',
        'forma_pagamento', // Dinheiro, Pix, Cartão
        'troco',
        'troco_para',
    ];

    public function order(): belongsTo // 1:1
    {
        return $this->belongsTo(Order::class);
    }
}
