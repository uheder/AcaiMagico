<?php

namespace App\Models;

use Database\Factories\OrderCoberturaItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCoberturaItem extends Model
{
    /** @use HasFactory<OrderCoberturaItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'cobertura_id',
    ];
}
