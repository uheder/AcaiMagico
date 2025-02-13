<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(): JsonResponse
    {
        $deliveries = Delivery::whereHas('order', function ($query) {
            $query->where('status', ['pronto para entrega', 'em rota de entrega']);
        })->with('order')->get();

        return response()->json($deliveries);
    }

    public function show(Delivery $delivery): JsonResponse
    {
        $delivery->load('order');
        return response()->json($delivery);
    }


    // será usado para atualizar o status do pedido
    public function update(Request $request, Delivery $delivery): JsonResponse
    {

        $validated = $request->validate([
            'status' => 'required |in: em rota de entrega, concluído, cancelado',
        ]);

        if (!$validated)
        {
            return response()->json(['error' => 'Status informado inválido. Verifique os dados e tente novamente.'], 400);
        }

        $order = $delivery->order;
        $order->status = $request->input('status');
        $order->save();

        $delivery->load('order');
        return response()->json($delivery, 202);
    }

}
