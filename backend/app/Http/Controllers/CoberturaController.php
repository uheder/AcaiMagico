<?php

namespace App\Http\Controllers;

use App\Models\Cobertura;
use Illuminate\Http\Request;

class CoberturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coberturas = Cobertura::all();
        return response()->json($coberturas->select('id','nome', 'status'));
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

        $cobertura = new Cobertura();
        $cobertura->nome = $request["nome"];
        $cobertura->status = $request["status"] ?? 'ativo';
        $cobertura->save();
        return response()->json($cobertura, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coberturas = Cobertura::all();
        return response()->json($coberturas->find($id));
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

        $coberturas = Cobertura::all();
        $cobertura = $coberturas->find($id);
        $cobertura->nome = $request["nome"] ?? $cobertura->nome;
        $cobertura->status = $request["status"] ?? $cobertura->status;
        $cobertura->save();
        return response()->json($cobertura, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cobertura::all()->find($id)->delete();
        return response()->json(null, 204);
    }
}
