<?php

namespace Database\Factories;

use App\Models\Acompanhamento;
use App\Models\OrderAcompanhamentoItem;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderAcompanhamentoItem>
 */
class OrderAcompanhamentoItemFactory extends Factory
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
            'acompanhamento_id' => Acompanhamento::factory(),
        ];
    }
}
