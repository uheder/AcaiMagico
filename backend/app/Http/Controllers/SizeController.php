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

    public function show(int $id): JsonResponse
    {
        return response()->json(Size::find($id));
    }

    public function create(): View
    {
        return view('sizes.create');

        // TODO: create form
    }

    public function store(Request $request)
    {
        $request->validate
        ([
            'nome' => 'required | string | max:55| unique:sizes',
            'valor' => 'required | decimal:0,2 | min:7',
            'max_cremes' => 'required | integer| min:1',
            'max_recheios' => 'required | integer | min:3',
            'max_acompanhamentos' => 'required | integer | min:1',
            'max_coberturas' => 'required | integer | min:1',
        ]);

        $size = new Size();
        $size->nome = $request['nome'];
        $size->valor = (float) $request['valor'];
        $size->max_cremes = $request['max_cremes'];
        $size->max_recheios = $request['max_recheios'];
        $size->max_acompanhamentos = $request['max_acompanhamentos'];
        $size->max_coberturas = $request['max_coberturas'];
        $size->save();

        return response()->json([
            $size, 201
        ]);
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
        ]);

        Size::find($id)->update($request->all());
        return response()->json([
            [Size::find($id), 202],
        ]);
    }

    public function delete(int $id)
    {
        Size::find($id)->delete();
        return redirect()->route('sizes.index');
    }
}
