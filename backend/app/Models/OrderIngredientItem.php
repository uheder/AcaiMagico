<?php

namespace App\Models;

use Database\Factories\OrderIngredientItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// pivot table
class OrderIngredientItem extends Model
{
    /** @use HasFactory<OrderIngredientItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'ingredient_id',
    ];

}
