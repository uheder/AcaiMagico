<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(OrderItem::all()->load(['size', 'order']));
    }
    public function update(Request $request, OrderItem $orderItem): JsonResponse
    {
        // altera somente a quantidade, valor é calculado com base nisso
        $validated = $request->validate([
            'quantidade' => 'required|integer|min:1',
        ]);

        if (!$validated) {
            return response()->json(['error' => 'Erro ao atualizar o item do pedido Verifique os dados e tente novamente.'], 400);
        }

        $orderItem->quantidade = $request->input('quantidade');
        $orderItem->valor_item = $orderItem->size()->valor * $orderItem->quantidade;
        $orderItem->save();

        return response()->json($orderItem, 202);
    }

    public function delete(Request $request, OrderItem $orderItem): void
    {
        $orderItem->delete();
    }
}
