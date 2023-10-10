<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficaController extends Controller
{
    //
    public function mostrarGrafica()
    {
        return view('grafica');
    }
}
