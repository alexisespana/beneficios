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
                
                <form class="row g-3" method="POST" action="/Beneficios/guardar">
                    @csrf
                    <input type="hidden" class="form-control" id="id_benef" name="id_benef"
                        value="{!! is_null($Beneficios) ? '' : $Beneficios->id !!}">

                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre del Beneficio</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{!! is_null($Beneficios) ? '' : $Beneficios->nombre !!}">
                    </div>
                    <div class="col-md-4">
                        <label for="fecha" class="form-label">fecha</label>
                        <input type="text" class="form-control" id="fecha" name="fecha"
                            value="{!! is_null($Beneficios) ? \Carbon\Carbon::now()->toDateString() : $Beneficios->fecha !!}">
                    </div>
                    <div class="col-md-4">

                        <label for="ficha" class="form-label">Ficha</label>
                        <select id="ficha" class="form-select" name="ficha">
                            @foreach ($ficha as $item)
                                @php
                                    $selected = '';

                                @endphp
                                @if ($Beneficios != null)
                                    @if ($Beneficios->id_ficha == $item->id)
                                        @php
                                            $selected = 'selected';

                                        @endphp
                                    @endif
                                @endif
                                <option {{ $selected }} value="{!! $item->id !!}">{!! $item->nombre !!} -
                                    publicada :{!! $item->publicada !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="monto_minimo" class="form-label">Monto Mínimo</label>
                        <input type="number" class="form-control" id="monto_minimo" name="monto_minimo"
                            value="{!! is_null($Beneficios) ? '' : $Beneficios->monto_minimo !!}">
                    </div>
                    <div class="col-md-4">
                        <label for="monto_maximo" class="form-label">Monto Máximo</label>
                        <input type="number" class="form-control" id="monto_maximo" name="monto_maximo"
                            value="{!! is_null($Beneficios) ? '' : $Beneficios->monto_maximo !!}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
