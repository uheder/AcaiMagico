<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderIngredientItem;
use App\Models\OrderItem;
use App\Models\Size;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Size::factory()->count(10)->create();

        Ingredient::factory()->count(10)->create();

        Order::factory()->count(10)->create()->each(function (Order $order)
        {
            OrderItem::factory()->count(rand(1, 3))->create
            ([
                'order_id' => $order->id,
            ])->each
            (function ($orderItem)
            {
                OrderIngredientItem::factory()->count(rand(1, 3))->create
                ([
                    'order_item_id' => $orderItem->id,
                ]);
            });

            if ($order->tipo_entrega === 'Entrega')
            {
                Delivery::factory()->create
                ([
                    'order_id' => $order->id,
                ]);
            }
        });
    }
}
