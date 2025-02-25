<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use Illuminate\Http\Request;

class AcompanhamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acompanhamento = Acompanhamento::all();
        return response()->json($acompanhamento->select('id','nome', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:25',
            'status' => 'in:ativo,inativo'
        ]);

        $acompanhamento = new Acompanhamento();
        $acompanhamento->nome = $request["nome"];
        $acompanhamento->status = $request["status"] ?? 'ativo';
        $acompanhamento->save();
        return response()->json($acompanhamento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $acompanhamentos = Acompanhamento::all();
        return response()->json($acompanhamentos->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'string|max:25',
            'status' => 'in:ativo,inativo'
        ]);

        $acompanhamentos = Acompanhamento::all();
        $acompanhamento = $acompanhamentos->find($id);
        $acompanhamento->nome = $request["nome"] ?? $acompanhamento->nome;
        $acompanhamento->status = $request["status"] ?? $acompanhamento->status;
        $acompanhamento->save();
        return response()->json($acompanhamento, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Acompanhamento::all()->find($id)->delete();
        return response()->json(null, 204);
    }
}
