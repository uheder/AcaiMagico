<?php

namespace App\Http\Controllers;

use App\Models\Creme;
use Illuminate\Http\Request;

class CremeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cremes = Creme::all();
        return response()->json($cremes->select('nome', 'status'));
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

        $creme = new Creme();
        $creme->nome = $request["nome"];
        $creme->status = $request["status"] ?? 'ativo';
        $creme->save();
        return response()->json($creme, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cremes = Creme::all();
        return response()->json($cremes->find($id));
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
        $cremes = Creme::all();
        $creme = $cremes->find($id);
        $creme->nome = $request["nome"] ?? $creme->nome;
        $creme->status = $request["status"] ?? $creme->status;
        $creme->save();
        return response()->json($creme, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        Creme::all()->find($id)->delete();
        return response()->json(null, 204);
    }
}
