<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait BeneficiosUsuariosTrait
{

    public function BeneficiosUsuarios($run, $dv)
    {


        $beneficio = DB::table('beneficios_entregados as be')
            ->join('beneficios as b', 'b.id', 'be.id_beneficio')
            // ->join('ficha as f', 'f.id', 'b.id_ficha')
            ->select('be.id', 'be.id_beneficio', 'be.total', 'be.fecha', 'b.nombre', 'b.id_ficha')
            ->where([["run", $run], ["dv", $dv]])->get();

        // dd($beneficio[0]);

        $data = collect($beneficio)->map(function ($benf, $key) {

            $fechaFormat =  Carbon::parse($benf->fecha);
            $anio =  substr($fechaFormat->format('d-m-Y'), -4, 4);
            $montos =  DB::table('montos_maximos')->where('id_beneficio', $benf->id_beneficio)->select('monto_minimo', 'monto_maximo')->first();

            if ($benf->total <= $montos->monto_maximo) {
                // dd($benf, $montos);



                $montos->monto_maximo =  '$' . number_format($montos->monto_maximo, 0, ',', '.');
                $montos->monto_minimo = '$' . number_format($montos->monto_minimo, 0, ',', '.');
                $ficha =  DB::table('ficha')->where([['id', $benf->id_ficha], ['publicada', 'true']])->first();

                // dd($ficha);

                // if($ficha)
                // {
                    $beneficios= ['sa'];
                    return  $beneficios = (object) [
                        'id' => $benf->id,
                        "nombre_benefcio" => $benf->nombre,
                        "total" => '$' . number_format($benf->total, 0, ',', '.'),
                        "fecha" => $fechaFormat->format('d-m-Y'),
                        "mes" =>  ucwords($fechaFormat->monthName),
                        "anio" => $anio,
                        "monto" => $montos,
                        "ficha" => $ficha ? $ficha :  'Ficha no publicada',
                        
                    ];
                // }
            }
        });

        // dd($data);

        $beneficiosAg = [];

        foreach ($data as $key => $benf) {
            //Recorremos los datos del array y si no es null agrupamos por anio
            if (!is_null($data[$key])) {

                $anioBenef = $benf->anio;
                $beneficiosAg[$anioBenef][] = $benf;
            }
        }

        // dd($beneficiosAg);

        // AQUI LIMPIAMOS EL ARRAY DATA DE TODOS LOS VALORES QUE VENGAN NULL

        $benefAgru = [];
        //  SI EL ARRAY TIENE ALGUN BENEFICIO LO RECORREMOS PARA CONTAR LA CANTIDAD DE CADA BENEFICIO POR AÑO
        if (count($beneficiosAg) > 0) {
            foreach ($beneficiosAg as $key => $value) {
                $total = 0;
                foreach ($value as $keys => $tot) {
                    $total += str_replace(['$', '.'], '', $tot->total); //para sumar los valores totales
                }

                // dd($value);
                $benefAgru[] = (object)[
                    'year' => $key,
                    'cantidad_beneficios' => count($value),
                    'total' => '$' . number_format($total, 0, ',', '.'),
                    'beneficios' => $value,
                ];
            }
        }
        // dd($benefAgru);

        return $benefAgru;
    }
}
