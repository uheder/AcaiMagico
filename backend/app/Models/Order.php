<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'nome_cliente',
        'status', // Pendente, Montando, Pronto, Em Rota de Entrega, Concluído
        'total',
        'observacao',
        'entrega', // True or False
    ];

    public function items(): HasMany // 1:N
    {
        return $this->hasMany(OrderItem::class);
    }

    public function delivery(): HasOne // 1:1
    {
        return $this->hasOne(Delivery::class);
    }
}
