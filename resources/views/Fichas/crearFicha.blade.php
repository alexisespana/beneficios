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
                <form class="row g-3" method="POST" action="/Ficha/guardar">
                    @csrf
                    <input type="hidden" class="form-control" id="id_benef" name="id_ficha"
                        value="{!! is_null($ficha) ? '' : $ficha->id !!}">

                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre de la ficha</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{!! is_null($ficha) ? '' : $ficha->nombre !!}">
                    </div>

                    <div class="col-md-4">

                        <label for="publicada" class="form-label">publicada</label>
                        <select id="publicada" class="form-select" name="publicada">

                            <option value="true">true</option>
                            @if ($ficha && $ficha->publicada === 'false')
                                <option selected value="false">false</option>
                                @else
                                <option value="false">false</option>

                            @endif





                        </select>
                    </div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
