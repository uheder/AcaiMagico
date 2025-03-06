<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SizeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Size::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate
        ([
            'nome' => 'required | string | max:55| unique:sizes',
            'valor' => 'required | decimal:0,2 | min:7',
            'max_cremes' => 'required | integer| min:1',
            'max_recheios' => 'required | integer | min:3',
            'max_acompanhamentos' => 'required | integer | min:1',
            'max_coberturas' => 'required | integer | min:1',
            'status' => 'in:ativo,inativo'
        ]);

        if (!$data) {
            return response()->json(['error' => 'Erro ao criar o tamanho. Verifique os dados e tente novamente.'], 400);
        }

        $size = new Size();
        $size->nome = $data['nome'];
        $size->valor = (float) $data['valor'];
        $size->max_cremes = $data['max_cremes'];
        $size->max_recheios = $data['max_recheios'];
        $size->max_acompanhamentos = $data['max_acompanhamentos'];
        $size->max_coberturas = $data['max_coberturas'];
        $size->status = $data['status'] ? : 'ativo';
        $size->save();

        return response()->json($size, 201);
    }
    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'nome' => 'string | max:55 | unique:sizes',
            'valor' => 'decimal: 0, 2 | min:7',
            'max_cremes' => 'integer | min:1',
            'max_recheios' => 'integer| min:3',
            'max_acompanhamentos' => 'integer | min:1',
            'max_coberturas' => 'integer | min:1',
            'status' => 'in:ativo,inativo'
        ]);

        $sizes = Size::all();
        $size = $sizes->find($id);
        $size->nome = $request['nome'] ?? $size->nome;
        $size->valor = $request['valor'] ?? $size->valor;
        $size->max_cremes = $request['max_cremes'] ?? $size->max_cremes;
        $size->max_recheios = $request['max_recheios'] ?? $size->max_recheios;
        $size->max_acompanhamentos = $request['max_acompanhamentos'] ?? $size->max_acompanhamentos;
        $size->max_coberturas = $request['max_coberturas'] ?? $size->max_coberturas;
        $size->status = $request['status'] ?? $size->status;
        $size->save();
        return response()->json($size);
    }

    public function destroy(int $id)
    {
        Size::find($id)->delete();
    }
}
