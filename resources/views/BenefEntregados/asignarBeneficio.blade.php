@extends('layouts.inicio')
@section('title', 'Crear Beneficios')
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

        <div class="card">
            <div class="card-body">

                <form class="row g-3" method="POST" action="/Beneficios-entregados/asignar">
                    @csrf
                    <input type="hidden" class="form-control" id="userid" name="userid"
                        value="{!! is_null($usuarios) ? '' : $usuarios->id !!}">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre del Beneficio</label>
                        <input type="text" disabled class="form-control" id="nombre" name="nombre"
                            value="{!! is_null($usuarios) ? '' : $usuarios->nombres !!}">
                    </div>
                    <div class="col-md-6">
                        <label for="run" class="form-label">run del Beneficio</label>
                        <input type="text" disabled class="form-control" id="run" name="run"
                            value="{!! is_null($usuarios) ? '' : $usuarios->run !!}">
                    </div>

                    <div class="col-md-4">

                        <label for="id_beneficio" class="form-label">Beneficios</label>
                        <select id="id_beneficio" class="form-select" name="id_beneficio">
                            @foreach ($beneficios as $item)
                                <option value="{!! $item->id !!}">{!! $item->nombre !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="total" class="form-label">total</label>
                        <input type="number" class="form-control" id="total" name="total" value="">
                    </div>

                    <div class="col-md-4">
                        <label for="fecha" class="form-label">fecha</label>
                        <input type="text" class="form-control" id="fecha" name="fecha"
                            value="{!! \Carbon\Carbon::now()->toDateString() !!}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
