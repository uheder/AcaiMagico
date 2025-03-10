<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    // carrega somente os pedidos pendentes
    public function index(): JsonResponse
    {
        return response()->json(Order::where('status', ['Pendente', 'Montando'])
            ->with([
                'items', 'items.creme', 'items.recheio', 'items.acompanhamento', 'items.cobertura', 'delivery'])->get()
            );
    }
    public function show(int $id): JsonResponse
    {
        $order = Order::find($id)->load(['items', 'items.creme', 'items.recheio', 'items.acompanhamento', 'items.cobertura', 'delivery']);
        return response()->json($order);
    }

    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'nome_cliente' => 'required|string|max:55',
            'tipo_entrega' => 'required|string|in:Entrega,Retirada',
            'telefone_cliente' => 'required_if: tipo_entrega, Entrega|string|max:15|nullable',
            'rua' => 'required_if:tipo_entrega,Entrega|string|max:55|nullable',
            'numero' => 'required_if:tipo_entrega,Entrega|string|max:10|nullable',
            'bairro' => 'required_if:tipo_entrega,Entrega|string|max:55|nullable',
            'referencia' => 'required_if:tipo_entrega,Entrega|string|max:255|nullable',
            'forma_pagamento' => 'required_if:tipo_entrega,Entrega|string|in:Dinheiro,Pix,Cartão|nullable',
            'troco' => 'required_if:forma_pagamento,Dinheiro|boolean|nullable',
            'troco_para' => 'required_if:troco,true|numeric|max:200|nullable',
            'observacao' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.size_id' => 'required|integer|exists:sizes,id',
            'items.*.quantidade' => 'required|integer|min:1',
            'items.*.creme' => 'array',
            'items.*.creme.*' => 'integer|exists:cremes,id',
            'items.*.recheio' => 'array',
            'items.*.recheio.*' => 'integer|exists:recheios,id',
            'items.*.acompanhamento' => 'array',
            'items.*.acompanhamento.*' => 'integer|exists:acompanhamentos,id',
            'items.*.cobertura' => 'array',
            'items.*.cobertura.*' => 'integer|exists:coberturas,id',
        ]);

        $order = Order::create([
            'nome_cliente' => $request->input('nome_cliente'),
            'tipo_entrega' => $request->input('tipo_entrega'),
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

            $orderItem->creme()->attach($item['creme'] ?? []);
            $orderItem->recheio()->attach($item['recheio'] ?? []);
            $orderItem->acompanhamento()->attach($item['acompanhamento'] ?? []);
            $orderItem->cobertura()->attach($item['cobertura'] ?? []);
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
        $order->load('items', 'items.creme', 'items.recheio', 'items.acompanhamento', 'items.cobertura','delivery');

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
            'items', 'items.creme', 'items.recheio', 'items.acompanhamento', 'items.cobertura', 'delivery'
        ]);
        return response()->json($order, 202);
    }

    public function destroy(Order $order): void
    {
        $order->delete();
    }
}
