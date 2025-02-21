<?php

namespace App\Models;

use Database\Factories\OrderRecheioItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRecheioItem extends Model
{
    /** @use HasFactory<OrderRecheioItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'recheio_id',
    ];
}
