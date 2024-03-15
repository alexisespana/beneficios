<?php

namespace App\Http\Controllers;

use App\Traits\BeneficiosUsuariosTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    use BeneficiosUsuariosTrait;
    public function index(Request $request)
    {

        //         $usuarios = DB::table('usuarios')->get();
        // dd($usuarios);
        $usuarios = DB::table('usuarios')->get()->collect()->map(function ($benef, $key) {
            $benef->beneficios = $this->BeneficiosUsuarios($benef->run, $benef->dv);
            return  $benef;
        });
        // $this->BeneficiosUsuarios($run, $request);

        // dd($usuarios);
        return view('Usuarios.Usuarios', compact('usuarios'));
    }
    public function misbeneficios(Request $request)
    {
        // dd($request->run);
        $expRun = explode("-", $request->run);
        $run = $expRun[0];
        $dv = $expRun[1];
        $beneficios = $this->BeneficiosUsuarios($run, $dv);

        // dd($beneficios);

        return view('Usuarios.DetallesBeneficios', compact('beneficios'));
    }

    public function crear_usuarios(Request $request)
    {
        // dd($request->all());
        $validator =   $this->validator($request->all());
        // $validate =  Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['message' => 'No se pudo crear el Usuario', 'data' => $validator->errors()->all()], 422);


            // dd($validator->errors()->all());
        } else {


            // dd($request->all());
            $expRun = explode("-", $request->rut);
            $run = $expRun[0];
            $dv = $expRun[1];


            DB::table('usuarios')->insert([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'run' => $run,
                'dv' => $dv,

            ]);

            return redirect()->route('listar-usuarios')->with('message', 'Usuario agregado!');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            "nombres" => ['required'],
            "apellidos" => ['required'],
            "rut" => ['required', 'regex:/^[1-9]\d*\-(\d|k|K)$/'],
        ], [
            "nombres.required" => 'El campo :attribute es requerido.',
            "apellidos.required" => 'El campo :attribute es requerido.',
            "rut.regex" => 'El formato del campo :attribute no es válido.',

        ]);
    }
}
