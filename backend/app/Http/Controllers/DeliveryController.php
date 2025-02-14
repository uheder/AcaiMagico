<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::where('tipo_entrega', 'Entrega')
            ->whereIn('status', ['Pronto para Entrega', 'Em Rota de Entrega'])
            ->get();
        return response()->json($orders->load('delivery'));
    }

    public function show(int $id): JsonResponse
    {
        $delivery = Delivery::find($id);
        $delivery->load('order');

        return response()->json($delivery);
    }
}
