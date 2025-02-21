<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCoberturaItem extends Model
{
    protected $fillable = [
        'order_item_id',
        'cobertura_id',
    ];
}
