<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCremeItem extends Model
{
    protected $fillable = [
        'order_item_id',
        'creme_id',
    ];
}
