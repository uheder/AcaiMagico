<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IngredientController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Ingredient::all());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Ingredient::where('id', $id)->get());
    }

    public function create(Request $request): View
    {
        return view('ingredients.create');

        // TODO: create form
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nome' => 'required | string | max:25| unique:ingredients',
            'categoria' => 'required | string | max:15',
        ]);

        if (!$data) {
            return response()->json(['error' => 'Erro ao criar o ingrediente. Verifique os dados e tente novamente.'], 400);
        }

        $ingredient = new Ingredient();
        $ingredient->nome = $data['nome'];
        $ingredient->categoria = $data['categoria'];
        $ingredient->save();

        return response()->json($ingredient, 201);
    }

    public function edit(int $id): View
    {
        return view('ingredients.edit');

        // TODO: create form
    }

    public function update(Request $request,int $id): JsonResponse
    {
        $data = $request->validate([
            'nome' => 'required | string | max:25| unique:ingredients',
            'categoria' => 'required | string | max:15',
        ]);
        $ingredient = Ingredient::find($id);
        $ingredient->update($data);

        return response()->json($ingredient, 202);
    }

    public function delete(int $id): RedirectResponse
    {
        Ingredient::find($id)->delete();
        return redirect()->route('ingredients.index');
    }
}
