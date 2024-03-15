@extends('layouts.inicio')
@section('title', 'Lista de Productos')
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
            <p class="fs-1">Lista de Beneficios</p>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/Beneficios/crear" class="btn btn-primary" role="button" aria-disabled="true">Agregar Beneficios</a>

        </div>

        <table class="table table-striped pull-right">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Beneficios</th>
                    <th scope="col">Nombre Ficha</th>
                    <th scope="col">Publicada</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Monto Máximo</th>
                    <th scope="col">Monto Minimo</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($data))
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $item->nombre !!}</td>
                            <td>{!! $item->nomb_ficha !!}</td>
                            <td>{!! $item->publicada !!}</td>
                            <td>{!! $item->fecha !!}</td>
                            <td>{!! $item->monto_maximo !!}</td>
                            <td>{!! $item->monto_minimo !!}</td>
                            <td>
                                <a href="/Beneficios/editar/{!! $item->id !!}" class="btn btn-primary" role="button"
                                    aria-disabled="true">Editar</a>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No existen usuarios registrados</td>
                    </tr>

                @endif


            </tbody>
        </table>
    </div>
@endsection
