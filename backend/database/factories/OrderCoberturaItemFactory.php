<?php

namespace Database\Factories;

use App\Models\Cobertura;
use App\Models\OrderCoberturaItem;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderCoberturaItem>
 */
class OrderCoberturaItemFactory extends Factory
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
            'cobertura_id' => Cobertura::factory(),
        ];
    }
}
