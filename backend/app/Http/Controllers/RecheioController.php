<?php

namespace App\Http\Controllers;

use App\Models\Recheio;
use Illuminate\Http\Request;

class RecheioController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $recheios = Recheio::all();
        return response()->json($recheios->select('id','nome', 'status'));
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

        $recheio = new Recheio();
        $recheio->nome = $request["nome"];
        $recheio->status = $request["status"] ?? 'ativo';
        $recheio->save();
        return response()->json($recheio, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recheios = Recheio::all();
        return response()->json($recheios->find($id));
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
        $recheios = Recheio::all();
        $recheio = $recheios->find($id);
        $recheio->nome = $request["nome"] ?? $recheio->nome;
        $recheio->status = $request["status"] ?? $recheio->status;
        $recheio->save();
        return response()->json($recheio, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Recheio::all()->find($id)->delete();
        return response()->json(null, 204);
    }

}
