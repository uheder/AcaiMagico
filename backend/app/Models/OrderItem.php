<?php

namespace App\Models;

use Database\Factories\OrderItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderItem extends Model
{
    /** @use HasFactory<OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'size_id',
        'quantidade', // pode ter mais de um item iguais
        'valor_item', // soma de valores da tabela sizes
    ];

    public function order(): BelongsTo // 1 ítem pertence somente a 1 pedido
    {
        return $this->belongsTo(Order::class);
    }

    public function size(): BelongsTo // 1 tamanho de ítem do pedido pertence somente a 1 pedido
    {
        return $this->belongsTo(Size::class);
    }

    public function ingredient(): BelongsToMany // muitos ingredientes para um ítem
    {
        return $this->belongsToMany(Ingredient::class, 'order_ingredient_items');
    }
}
