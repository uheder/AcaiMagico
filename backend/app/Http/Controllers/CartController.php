<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        $request->validate([
            'tamanho' => 'required|array',
            'creme' => 'array',
            'recheio' => 'array',
            'acompanhamento' => 'array',
            'cobertura' => 'array',
            'valor_item' => 'required|numeric'
        ]);

        $item = [
            'tamanho' => $request->input('tamanho'),
            'creme' => $request->input('creme'),
            'recheio' => $request->input('recheio'),
            'acompanhamento' => $request->input('acompanhamento'),
            'cobertura' => $request->input('cobertura'),
            'valor_item' => $request->input('valor_item'),
        ];

        $cart[] = $item;
        session(['cart' => $cart]);
        return response()->json($cart);
    }

    public function destroy($index)
    {
        $cart = session('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            session(['cart' => $cart]);
            return response()->json($cart);
        }
        return response()->json('Item não encontrado', 404);
    }
}
