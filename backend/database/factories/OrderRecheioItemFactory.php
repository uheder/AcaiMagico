<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\OrderRecheioItem;
use App\Models\Recheio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderRecheioItem>
 */
class OrderRecheioItemFactory extends Factory
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
            'recheio_id' => Recheio::factory(),
        ];
    }
}
