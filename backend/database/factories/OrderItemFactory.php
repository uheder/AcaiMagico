<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'size_id' => Size::factory(),
            'quantidade' => $this->faker->numberBetween(1, 5),
            'valor_item' => 0,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(callback: function (OrderItem $orderItem) {
            $orderItem->valor_item = $orderItem->size->valor * $orderItem->quantidade;
            $orderItem->save();
        });
    }
}
