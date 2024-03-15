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
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary" onclick="agregar()">
                Agregar Usuario
            </button>
        </div>

        <table class="table table-striped pull-right">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Beneficios</th>
                    <th scope="col">detalles</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($usuarios))
                    @foreach ($usuarios as $key => $item)
                        <tr>
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $item->nombres !!} {!! $item->apellidos !!}</td>
                            <td>{!! $item->run !!}-{!! $item->dv !!}</td>
                            <td>{!! count($item->beneficios) !!} </td>
                            <td><a  href="/Usuarios/misbeneficios/{!! $item->run !!}-{!! $item->dv !!}"
                                    class="btn {!! count($item->beneficios) == 0 ?'disabled ' :'btn-primary' !!}" role="button" aria-disabled="true">ver Beneficios</a></td>
                            <td>
                                <a href="/Beneficios-entregados/agregar/{!! $item->id !!}" class="btn btn-primary"
                                    role="button" aria-disabled="true">Agregar Beneficios</a>
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
@section('scripts')

    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

        });

        function agregar() {
            ajax();

        }

        function ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //we will send data and recive data fom our AjaxController
            $.ajax({
                url: '/Usuarios/agregar-usuario',

                type: 'GET',
                success: function(response) {

                    $('#editarProductos').empty();
                    $('.modal-body').empty().append(response);
                    $('.modal').modal('show');

                },
                statusCode: {
                    404: function() {
                        alert('web not found');
                    }
                },
                error: function(x, xs, xt) {
                    //nos dara el error si es que hay alguno
                    // window.open(JSON.stringify(x));
                    console.log('error: ' + JSON.stringify(x) + "\n error string: " + xs +
                        "\n error throwed: " + xt);
                }
            });
        }
    </script>
@endsection
@endsection
