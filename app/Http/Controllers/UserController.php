<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserData()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return response()->json(['user' => $user], 200);
    }

    public function editUser()
    {
        return view('actualizar');
    }
    public function updateUserData(Request $request)
    {
        $user = Auth::user();

        // Actualizar los datos del usuario con los datos proporcionados
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return response()->json(['message' => 'Datos de usuario actualizados con éxito'], 200);
    }


}
