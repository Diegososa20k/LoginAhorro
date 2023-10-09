<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ahorro;
use Illuminate\Support\Facades\Auth;

class AhorroController extends Controller
{
    public function getUserAhorros()
{
    $ahorros = Auth::user()->ahorros;

    return response()->json(['ahorros' => $ahorros], 200);
}


    public function store(Request $request)
    {
        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'porcentaje' => 'required|numeric',
        //     'ahorro' => 'required|numeric',
        //     'gasto' => 'required|numeric',
        //     'descripcion' => 'nullable|string',
        //     'resultadoAcumulados' => 'required|numeric',
        // ]);

        $ahorro = Auth::user()->ahorros()->create($request->all());

        return response()->json(['ahorro' => $ahorro], 201);
    }


}
