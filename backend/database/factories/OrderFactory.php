<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_cliente' => $this->faker->name(),
            'observacao' => $this->faker->text(),
            'tipo_entrega' => $this->faker->randomElement(['Entrega', 'Retirada']),
            'total' => 0
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
            //garante que order_items existe antes de atualizar o total
            OrderItem::factory()->count(3)->create(['order_id' => $order->id]);
            $order->update([
                'total' => $order->items()->sum('valor_item')
            ]);
        });
    }
}
