@extends('layouts.inicio')
@section('title', 'mis beneficios')
@section('css')
@endsection

@section('content')
    <div class="p-5">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
                <a href="/Usuarios/listar" class="btn btn-secondary" role="button" aria-disabled="true">atras</a>

            </div>
            @foreach ($beneficios as $item)
                <div class="col-sm py-2">
                    <div class="card border-primary">
                        <div class="card-body text-primary">
                            <h5 class="card-title text-end">año: {{ $item->year }} </h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">cantidad Beneficios:
                                {{ $item->cantidad_beneficios }} </h6>
                            <h6 class="card-subtitle mb-2 text-body text-end">suma total: {{ $item->total }} </h6>
                            @foreach ($item->beneficios as $key => $benf)
                                <ul class="list-group list-group-flush pb-5">
                                    <p>Beneficio: {{ $key + 1 }}
                                    </p>
                                    <li class="list-group-item"><strong>Nombre:</strong> {{ $benf->nombre_benefcio }} </li>
                                    <li class="list-group-item"><strong>total:</strong> {{ $benf->total }}</li>
                                    <li class="list-group-item"><strong>fecha:</strong> {{ $benf->fecha }}</li>
                                    <li class="list-group-item"><strong>mes:</strong> {{ $benf->mes }}</li>
                                    <li class="list-group-item"><strong>monto máximo:</strong>
                                        {{ $benf->monto->monto_maximo }}</li>
                                    <li class="list-group-item"><strong>monto mínimo:</strong>
                                        {{ $benf->monto->monto_minimo }}</li>
                                    <li class="list-group-item"><strong>ficha:</strong>
                                        {{ isset($benf->ficha->nombre) ? $benf->ficha->nombre : $benf->ficha }}</li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
@endsection
