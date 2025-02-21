<?php

namespace Database\Factories;

use App\Models\Creme;
use App\Models\OrderCremeItem;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderCremeItem>
 */
class OrderCremeItemFactory extends Factory
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
            'creme_id' => Creme::factory(),
        ];
    }
}
