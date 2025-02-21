<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAcompanhamentoItem extends Model
{
    protected $fillable = [
        'order_item_id',
        'acompanhamento_id',
    ];
}
