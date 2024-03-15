@extends('layouts.inicio')
@section('title', 'Lista de Productos')
@section('css')
@endsection

@section('content')
    <div class="p-5">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    {{ session('message') }}
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-12 text-center">
            <p class="fs-1">Lista de ficha</p>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/Ficha/crear" class="btn btn-primary" role="button" aria-disabled="true">Agregar ficha</a>

        </div>

        <table class="table table-striped pull-right">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Publicada</th>
                    <th scope="col">URL</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($fichas))
                    @foreach ($fichas as $key => $item)
                        <tr>
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $item->nombre !!}</td>
                            <td>{!! $item->publicada !!}</td>
                            <td>{!! $item->url !!}</td>
                            <td>
                                <a href="/Ficha/editar/{!! $item->id !!}" class="btn btn-primary" role="button"
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
