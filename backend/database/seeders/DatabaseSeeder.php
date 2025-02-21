<?php

namespace Database\Seeders;

use App\Models\Acompanhamento;
use App\Models\Cobertura;
use App\Models\Creme;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderAcompanhamentoItem;
use App\Models\OrderCoberturaItem;
use App\Models\OrderCremeItem;
use App\Models\OrderItem;
use App\Models\OrderRecheioItem;
use App\Models\Recheio;
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

        Creme::factory()->count(10)->create();
        Recheio::factory()->count(10)->create();
        Acompanhamento::factory()->count(10)->create();
        Cobertura::factory()->count(10)->create();

        Order::factory()->count(10)->create()->each(function (Order $order)
        {
            OrderItem::factory()->count(rand(1, 3))->create
            ([
                'order_id' => $order->id,
            ])->each
            (function ($orderItem)
            {
                OrderCremeItem::factory()->count(rand(1, 3))->create
                ([
                    'order_item_id' => $orderItem->id,
                ]);

                OrderRecheioItem::factory()->count(rand(1, 3))->create
                ([
                    'order_item_id' => $orderItem->id,
                ]);

                OrderAcompanhamentoItem::factory()->count(rand(1, 3))->create
                ([
                    'order_item_id' => $orderItem->id,
                ]);

                OrderCoberturaItem::factory()->count(rand(1, 3))->create
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
