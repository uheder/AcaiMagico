<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\IngredientOrderItem;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IngredientOrderItem>
 */
class IngredientOrderItemFactory extends Factory
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
