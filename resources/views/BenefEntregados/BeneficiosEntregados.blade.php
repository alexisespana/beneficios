@extends('layouts.inicio')
@section('title', 'Beneficios Entregados')
@section('css')
@endsection
@section('content')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                {{ session('message') }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="p-5">
        <div class="col-12 text-center">
            <p class="fs-1">Lista de Beneficios Entregados</p>
        </div>
        <table class="table table-striped pull-right">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Run</th>
                    <th scope="col">Beneficios</th>
                    <th scope="col">nombre Ficha</th>
                    <th scope="col">Ficha publicada</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Monto Máximo</th>
                    <th scope="col">Monto Minimo</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($beneficios))
                    @foreach ($beneficios as $key => $item)
                        <tr >
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $item->run !!} </td>
                            <td>{!! $item->nomb_benef !!}</td>
                            <td>{!! $item->nomb_ficha !!}</td>
                            <td>{!! $item->publicada !!}</td>
                            <td>{!! $item->total !!}</td>
                            <td>{!! $item->fecha !!}</td>
                            <td>{!! $item->monto_maximo !!}</td>
                            <td>{!! $item->monto_minimo !!}</td>
                            {{-- <td>
                                <a href="/Beneficios/editar/{!! $item->id !!}" class="btn btn-primary" role="button"
                                    aria-disabled="true">Editar</a>
                            </td> --}}

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No existen beneficios asignados</td>
                    </tr>

                @endif


            </tbody>
        </table>
    </div>
@endsection
