<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', [
            'items' => [],
            'total' => 0,
        ]);
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $cart = session('cart', [
            'items' => [],
            'total' => 0,
        ]);

        $request->validate([
            'tamanho' => 'required',
            'creme' => 'array',
            'recheio' => 'array',
            'acompanhamento' => 'array',
            'cobertura' => 'array',
            'valor_item' => 'required|numeric',
            'quantidade' => 'required|integer'
        ]);

        $item = [
            'tamanho' => $request->input('tamanho'),
            'creme' => $request->input('creme'),
            'recheio' => $request->input('recheio'),
            'acompanhamento' => $request->input('acompanhamento'),
            'cobertura' => $request->input('cobertura'),
            'valor_item' => $request->input('valor_item'),
            'quantidade' => $request->input('quantidade'),
        ];

        $cart["items"][] = $item;
        $cart["total"] += $item["valor_item"] * $item["quantidade"];
        session(['cart' => $cart]);
        return response()->json($cart);
    }

    public function destroy($index)
    {
        $cart = session('cart', [
            'items' => [],
            'total' => 0,
        ]);

        if (isset($cart['items'][$index])) {
            unset($cart['items'][$index]);
            $cart['items'] = array_values($cart['items']);

            // loop para pegar total do carrinho
            $cart['total'] = collect($cart['items'])->sum(function ($i) {
                return $i['valor_item'] * $i['quantidade'];
            });
        }

        session(['cart' => $cart]);
        return response()->json($cart);
    }
}
