<?php

namespace App\Models;

use Database\Factories\OrderCremeItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCremeItem extends Model
{
    /** @use HasFactory<OrderCremeItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'creme_id',
    ];
}
