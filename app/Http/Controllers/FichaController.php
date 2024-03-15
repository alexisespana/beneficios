<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FichaController extends Controller
{
    public function ficha(Request $request)
    {

        $fichas = DB::table('ficha')->orderBy('id','desc')->get();

        return view('Fichas.Fichas', compact('fichas'));
    }
    public function crear_ficha(Request $request)
    {
        $ficha = NULL;
        if (isset($request->id)) {
            $ficha = DB::table('ficha')->where('id', $request->id)->first();
        }
        // DD($ficha);
        return view('Fichas.crearFicha', compact('ficha'));
    }
    public function guardar_ficha(Request $request)
    {
        // dd($request->all());
        if ($request->id_ficha == NULL) { // SI EL id_ficha ES NULL SE VA A CREAR UNA NUEVA FICHA

        
            DB::table('ficha')->insert([
                'nombre' => $request->nombre,
                'publicada' => $request->publicada,

            ]);
            $message = 'Ficha agregada!';
        } else { // SI EL id_ficha NO ES NULL SE VA A MODIFICAR UNA FICHA

            $benef =  DB::table('ficha')
                ->where('id', $request->id_ficha)
                ->update([
                    'nombre' => $request->nombre,
                    'publicada' => $request->publicada,
                ]);

           
            $message = 'ficha Modificada!';
        }

        return redirect()->route('listar-fichas')->with('message', $message);
    }
}
