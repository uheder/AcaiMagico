<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\OrderIngredientItem;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderIngredientItem>
 */
class OrderIngredientItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_item_id' => OrderItem::factory(),
            'ingredient_id' => Ingredient::factory(),
        ];
    }
}
