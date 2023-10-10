<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ahorro;
use Illuminate\Support\Facades\Auth;

class AhorroController extends Controller
{

    public function index()
    {
        //Me trae todos los datos de mi usuario que se guarda en la tABLA
        $user = Auth::user();

        return Ahorro::where('user_id', $user->id)->get();
    }

    //Otra posible solucion para hacer post
//     public function store(Request $request)
// {
//     $request->validate([
//         'nombre' => 'required|string|max:255',

//     ]);

//     // Establecer resultadoAcumulado a 0 si no se proporciona
//     $resultadoAcumulado = $request->has('resultadoAcumulado') ? $request->resultadoAcumulado : 0;

//     $ahorro = Auth::user()->ahorros()->create([
//         'nombre' => $request->nombre,
//         'porcentaje' => $request->porcentaje,
//         'ahorro' => $request->ahorro,
//         'gasto' => $request->gasto,
//         'descripcion' => $request->descripcion,
//         'resultadoAcumulado' => $resultadoAcumulado,
//     ]);

//     return response()->json(['ahorro' => $ahorro], 201);
// }

    public function store(Request $request)
    {
         $request->validate([
             'nombre' => 'required|string|max:255',
        //     'porcentaje' => 'required|numeric',
        //     'ahorro' => 'required|numeric',
        //     'gasto' => 'required|numeric',
        //     'descripcion' => 'nullable|strinpg',
        //     'resultadoAcumulados' => 'required|numeric',
         ]);


        $ahorro = Auth::user()->ahorros()->create($request->all());

        return response()->json(['ahorro' => $ahorro], 201);
    }

    public function destroy(Request $request, Ahorro $ahorro)
    {
        $ahorro = Ahorro::find($request->id);

        $ahorro->delete();

        return response()->json(['success' => true], 200);
    }

    public function actualizarResultadoAcumulado(Request $request)
    {
        $request->validate([
            'actualizaciones.*.id' => 'required|exists:ahorros,id',
            'actualizaciones.*.resultadoAcumulado' => 'required|numeric',
        ]);

        $actualizaciones = $request->input('actualizaciones');

        foreach ($actualizaciones as $actualizacion) {
            $ahorro = Ahorro::find($actualizacion['id']);
            $ahorro->resultadoAcumulado = $actualizacion['resultadoAcumulado'];
            $ahorro->save();
        }

        return response()->json(['message' => 'Campos resultadoAcumulado actualizados correctamente']);
    }




    public function actualizarResultadoAcumuladoUno(Request $request, $id)
{
    $request->validate([
        'resultadoAcumulado' => 'required|numeric',
    ]);

    $ahorro = Ahorro::find($id);

    if (!$ahorro) {
        return response()->json(['message' => 'No se encontró el ahorro con el ID proporcionado'], 404);
    }

    $ahorro->resultadoAcumulado = $request->input('resultadoAcumulado');
    $ahorro->save();

    return response()->json(['message' => 'Campo resultadoAcumulado actualizado correctamente']);
}

public function update(Request $request, $id)
{


    $ahorro = Ahorro::find($id);

    if (!$ahorro) {
        return response()->json(['message' => 'Tarjeta no encontrada'], 404);
    }

    $ahorro->nombre = $request->nombre;
    $ahorro->porcentaje = $request->porcentaje;
    $ahorro->ahorro = $request->ahorro;
    $ahorro->gasto = $request->gasto;
    $ahorro->descripcion = $request->descripcion;
    $ahorro->resultadoAcumulado = $request->resultadoAcumulado;
    $ahorro->save();

    return response()->json(['message' => 'Tarjeta actualizada con éxito', 'ahorro' => $ahorro], 200);
}

}
