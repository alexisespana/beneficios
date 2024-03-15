<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeneficiosEntregadosController extends Controller

{
    public function listar(Request $request)
    {
        // $beneficios = DB::table('beneficios_entregados')->get();
        $data = DB::table('beneficios_entregados as be')
            ->join('usuarios as u', 'u.run', '=', 'be.run')
            ->join('beneficios as b', 'b.id', '=', 'be.id_beneficio')
            ->join('ficha as f', 'f.id', '=', 'b.id_ficha')
            ->join('montos_maximos as m', 'm.id_beneficio', '=', 'b.id')
            ->select('be.total', 'be.fecha', 'b.nombre as nomb_benef', 'u.run', 'u.dv', 'f.nombre as nomb_ficha', 'f.publicada', 'm.monto_maximo', 'm.monto_minimo')
            ->orderBy('u.run', 'ASC')
            ->get();
            $beneficios = collect($data)->map(function ($benef, $key) {
                return (object) [
                    // <td>{!! $item->nomb_benef !!}</td>
                    // <td>{!! $item->nomb_ficha !!}</td>
                    // <td>{!! $item->publicada !!}</td>
                    // <td>{!! $item->total !!}</td>
                    // <td>{!! $item->fecha !!}</td>
                    // <td>{!! $item->monto_maximo !!}</td>
                    // <td>{!! $item->monto_minimo !!}</td>
                    "run" => $benef->run.'-'.$benef->dv,
                    "nomb_benef" => $benef->nomb_benef,
                    "nomb_ficha" => $benef->nomb_ficha,
                    "publicada" => $benef->publicada,
                    "total" =>  '$' . number_format($benef->total, 0, ',', '.'),
                    "fecha" => Carbon::parse($benef->fecha)->format('d-m-Y'),
                    "monto_maximo" => '$' . number_format($benef->monto_maximo, 0, ',', '.'),
                    "monto_minimo" => '$' . number_format($benef->monto_minimo, 0, ',', '.'),
                ];
            });

        // dd($beneficios);
        return view('BenefEntregados.BeneficiosEntregados', compact('beneficios'));
    }
    public function agregar(Request $request)
    {

        $usuarios = DB::table('usuarios')->where('id', $request->id)->first();

        $beneficios = DB::table('beneficios')->get();
        // dd($usuarios, $beneficios);

        return view('BenefEntregados.asignarBeneficio', compact('usuarios', 'beneficios'));
    }

    public function asignarBeneficios(Request $request)
    {

        $usuarios = DB::table('usuarios')->where('id', $request->userid)->first();

        DB::table('beneficios_entregados')->insert([
            'id_beneficio' => $request->id_beneficio,
            'run' => $usuarios->run,
            'dv' => $usuarios->dv,
            'total' => isset($request->total) ? $request->total : 0,
            'fecha' => $request->fecha,
            'estado' => 1,

        ]);
        return redirect()->route('listar-usuarios')->with('message', 'beneficio asignado a Rut (' . $usuarios->run . '-' . $usuarios->dv . ').');
    }
}
