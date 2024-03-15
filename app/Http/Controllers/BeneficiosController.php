<?php

namespace App\Http\Controllers;

use App\Traits\BeneficiosUsuariosTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BeneficiosController extends Controller
{
    use BeneficiosUsuariosTrait;

    // servicio get que muestra el resultafo en JSON como se pidio en la pueba técnica

    public function index(Request $request)
    {



        $expRun = explode("-", $request->RUT);
        $run = $expRun[0];
        $dv = $expRun[1];
        $usuarios = DB::table('usuarios')->where([['run', $run], ['dv', $dv]])->count();

        // buscamos el rut ingresado en la tabla usuarios si esta registrado buscamos si tiene beneficios
        if ($usuarios > 0) {
            $code = Response::HTTP_OK;
            $success = true;
            $beneficios = $this->BeneficiosUsuarios($run, $dv);
        } else {
            $code = 500;
            $success = false;
            $beneficios = [];
        }
        return response()->json([
            'code' => $code,
            'success' => $success,
            'benefcios' => $beneficios,
        ]);
    }




    public function beneficios(Request $request)
    {

        $beneficios = DB::table('beneficios as b')
            ->join('ficha as f', 'f.id', '=', 'b.id_ficha')
            ->join('montos_maximos as m', 'm.id_beneficio', '=', 'b.id')
            ->select('b.*', 'f.url', 'f.nombre as nomb_ficha', 'f.publicada', 'm.monto_maximo', 'm.monto_minimo')
            ->orderBy('b.id', 'desc')
            ->get();
        $data = collect($beneficios)->map(function ($benef, $key) {
            return (object) [

                "id" => $benef->id,
                "nombre" => $benef->nombre,
                "id_ficha" => $benef->id_ficha,
                "fecha" => Carbon::parse($benef->fecha)->format('d-m-Y'),
                "url" => $benef->url,
                "nomb_ficha" => $benef->nomb_ficha,
                "publicada" => $benef->publicada,
                "monto_maximo" => '$' . number_format($benef->monto_maximo, 0, ',', '.'),
                "monto_minimo" => '$' . number_format($benef->monto_minimo, 0, ',', '.'),
            ];
        });

        // dd($data);

        return view('Beneficios.Beneficios', compact('data'));
    }
    public function crear_beneficios(Request $request)
    {
        $Beneficios = NULL;
        if (isset($request->id)) {

            $Beneficios = DB::table('beneficios as b')
                ->join('ficha as f', 'f.id', '=', 'b.id_ficha')
                ->join('montos_maximos as m', 'm.id_beneficio', '=', 'b.id')
                ->select('b.nombre', 'b.fecha', 'b.id_ficha', 'f.id', 'f.publicada', 'm.monto_maximo', 'm.monto_minimo')
                ->where('b.id', $request->id)->first();
        }

        // dd($Beneficios);
        $ficha = DB::table('ficha')->get();

        return view('Beneficios.crearBeneficios', compact('Beneficios', 'ficha'));
    }
    public function guardar_Beneficios(Request $request)
    {
        // dd($request->all());

        $validator =   $this->validator($request->all());

        // dd($validator->errors(),$request->all());
        // $validate =  Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message', 'No se puede crear el beneficio');


            // dd($validator->errors()->all());
        } else {

            if ($request->id_benef == NULL) { // SI EL ID_BENEF ES NULL SE VA A CREAR UN NUEVO BENEFICIO

                $benef =  DB::table('beneficios')->insertGetId([
                    'nombre' => $request->nombre,
                    'id_ficha' => $request->ficha,
                    'fecha' => $request->fecha,
                ]);

                DB::table('montos_maximos')->insert([
                    'id_beneficio' => $benef,
                    'monto_maximo' => $request->monto_maximo,
                    'monto_minimo' => $request->monto_minimo,

                ]);
                $message = 'Beneficio agregado!';
            } else { // SI EL ID_BENEF NO ES NULL SE VA A MODIFICAR BENEFICIO

                $benef =  DB::table('beneficios')
                    ->where('id', $request->id_benef)
                    ->update([
                        'nombre' => $request->nombre,
                        'id_ficha' => $request->ficha,
                        'fecha' => $request->fecha,
                    ]);

                DB::table('montos_maximos')
                    ->where('id', $request->id_benef)
                    ->update([
                        'monto_maximo' => $request->monto_maximo,
                        'monto_minimo' => $request->monto_minimo,

                    ]);
                $message = 'Beneficio Modificado!';
            }

            return redirect()->route('listar-beneficios')->with('message', $message);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            "nombre" => ['required'],
            "ficha" => ['required'],
            "fecha" => ['required', 'date_format:Y-m-d'],
        ], [
            "nombre.required" => 'El campo :attribute es requerido.',
            "ficha.required" => 'El campo ficha es requerido.',
            "fecha.required" => 'El campo :attribute es requerido.',
            "fecha.date_format" => 'El formato del campo :attribute no es válido.(YYYY-MM-DD)',

        ]);
    }
}
