<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    // carrega somente os pedidos pendentes
    public function index(): JsonResponse
    {
        return response()->json(Order::where('status', ['Pendente', 'Montando'])
            ->with(['items', 'delivery'])->get()
            );
    }
    public function show(int $id): JsonResponse
    {
        $order = Order::find($id)->load(['items', 'delivery']);
        return response()->json($order);
    }

    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'nome_cliente' => 'required|string|max:55',
            'telefone_cliente' => 'required_if: tipo_entrega, Entrega|string|max:15',
            'tipo_entrega' => 'required|string|in:Entrega,Retirada',
            'rua' => 'required_if:tipo_entrega,Entrega|string|max:55',
            'numero' => 'required_if:tipo_entrega,Entrega|string|max:10',
            'bairro' => 'required_if:tipo_entrega,Entrega|string|max:55',
            'referencia' => 'required_if:tipo_entrega,Entrega|string|max:255',
            'forma_pagamento' => 'required|string|in:Dinheiro,Pix,Cartão',
            'troco' => 'required_if:forma_pagamento,Dinheiro|boolean',
            'troco_para' => 'required_if:troco,true|numeric|max:55',
            'observacao' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.size_id' => 'required|integer|exists:sizes,id',
            'items.*.quantidade' => 'required|integer|min:1',
            'items.*.cremes' => 'array',
            'items.*.cremes.*' => 'integer|exists:cremes,id',
            'items.*.recheios' => 'array',
            'items.*.recheios.*' => 'integer|exists:recheios,id',
            'items.*.acompanhamentos' => 'array',
            'items.*.acompanhamentos.*' => 'integer|exists:acompanhamentos,id',
            'items.*.coberturas' => 'array',
            'items.*.coberturas.*' => 'integer|exists:coberturas,id',
        ]);

        $order = Order::create([
            'nome_cliente' => $request->input('nome_cliente'),
            'telefone_cliente' => $request->input('telefone_cliente'),
            'tipo_entrega' => $request->input('tipo_entrega'),
            'tipo_pagamento' => $request->input('tipo_pagamento'),
            'troco' => $request->input('troco'),
            'troco_para' => $request->input('troco_para'),
            'observacao' => $request->input('observacao'),
            'status' => 'Pendente',
            'total' => 0,
        ]);


        $total = 0;

        foreach ($request->input('items') as $item) {
            $orderItem = $order->items()->create([
                'size_id' => $item['size_id'],
                'quantidade' => $item['quantidade'],
                'valor_item' => 0,
            ]);

            $size = Size::find($item['size_id']);
            $orderItem->valor_item = $size->valor * $item['quantidade'];
            $orderItem->save();

            $orderItem->creme()->attach($item['cremes'] ?? []);
            $orderItem->recheio()->attach($item['recheios'] ?? []);
            $orderItem->acompanhamento()->attach($item['acompanhamentos'] ?? []);
            $orderItem->cobertura()->attach($item['coberturas'] ?? []);
            $total += $orderItem->valor_item;
        }

        if ($request['tipo_entrega'] === 'Entrega') {
            $order->delivery()->create([
                'nome_cliente' => $request['nome_cliente'],
                'telefone_cliente' => $request['telefone_cliente'],
                'rua' => $request['rua'],
                'numero' => $request['numero'],
                'bairro' => $request['bairro'],
                'referencia' => $request['referencia'],
                'forma_pagamento' => $request['forma_pagamento'],
                'troco' => $request['forma_pagamento'] === 'Dinheiro' ? $request['troco'] : false,
                'troco_para' => $request['troco'] ? $request["troco_para"] : null,
            ]);
        }

        $order->total = $total;
        $order->save();
        $order->load('items', 'items.cremes', 'items.recheios', 'items.acompanhamentos', 'items.coberturas','delivery');

        return response()->json($order, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'status' => 'required|string|in:Pendente,Montando,Pronto para Entrega,Em Rota de Entrega,Concluído,Cancelado',
        ]);

        $order = Order::find($id);
        $order->update([
            'status'=> $request['status']
        ]);
        $order->save();
        $order->load([
            'items', 'items.cremes', 'items.recheios', 'items.acompanhamentos', 'items.coberturas', 'delivery'
        ]);
        return response()->json($order, 202);
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }
}
