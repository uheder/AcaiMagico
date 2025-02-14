<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return mixed|array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'nome_cliente' => fn ($attributes) => Order::find($attributes['order_id'])->nome_cliente,
            'telefone_cliente' => $this->faker->phoneNumber(),
            'rua' => $this->faker->streetAddress(),
            'numero' => $this->faker->numberBetween(1, 100),
            'bairro' => $this->faker->text(55),
            'referencia' => $this->faker->text(255),
            'forma_pagamento' => $this->faker->randomElement(['Dinheiro', 'Pix', 'Cartão']),
            // retorna true somente se for em dinheiro e o faker voltar true
            'troco' => fn ($attributes) => ($attributes['forma_pagamento'] === 'Dinheiro' && $this->faker->boolean()),
            'troco_para' => fn($attributes) => ((!$attributes['troco']) ? null : $this->faker->randomFloat(0, 50, 100)),
        ];
    }
}
