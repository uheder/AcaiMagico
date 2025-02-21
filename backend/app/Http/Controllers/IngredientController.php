<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use App\Models\Cobertura;
use App\Models\Creme;
use App\Models\Recheio;
use Illuminate\Http\JsonResponse;

class IngredientController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'Cremes' => Creme::all()->select('nome', 'status'),
            'Recheios' => Recheio::all()->select('nome', 'status'),
            'Acompanhamentos' => Acompanhamento::all()->select('nome', 'status'),
            'Coberturas' => Cobertura::all()->select('nome', 'status'),
        ]);
    }
}
