<?php

namespace App\Models;

use Database\Factories\SizeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /** @use HasFactory<SizeFactory> */
    use HasFactory;
    protected $fillable = [
        'nome',
        'valor',
        'max_cremes',
        'max_recheios',
        'max_acompanhamentos',
        'max_coberturas',
    ];
}
