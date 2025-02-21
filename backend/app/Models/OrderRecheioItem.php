<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRecheioItem extends Model
{
    protected $fillable = [
        'order_item_id',
        'recheio_id',
    ];
}
