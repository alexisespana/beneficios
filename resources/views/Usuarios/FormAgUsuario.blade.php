<form class="col s12 form" method="POST">
    <div class="mb-3">
        <label for="rut" class="form-label">RUT</label>
        <input type="text" class="form-control" id="rut" name="rut" aria-describedby="rutHelp">
        <div id="rutHelp" class="form-text">ej(12345678-9).</div>

    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombres</label>
        <input type="email" class="form-control" id="nombres" name="nombres">
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos">
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion">
    </div>

    <button type="button" class="btn btn-primary" onclick="enviar()">Crear Usuario</button>
</form>

<div class="alert alert-danger alert-dismissible fade " role="alert">
    <strong>

    </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<script>
    function enviar() {
        $('.alert').empty().removeClass('show');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let rut = $("#rut").val();
        let nombres = $("#nombres").val();
        let apellidos = $("#apellidos").val();
        let direccion = $("#direccion").val();

        //we will send data and recive data fom our AjaxController
        $.ajax({
            url: '/Usuarios/crearUsuarios',
            data: {
                'rut': rut,
                'nombres': nombres,
                'apellidos': apellidos,
                'direccion': direccion,
            },
            type: 'POST',
            success: function(response) {

                
                $('.modal').modal('hide');
                setTimeout(
                  function() 
                  {
                     location.reload();
                  }, 0001);   

            },
            statusCode: {
                404: function() {
                    alert('web not found');
                }
            },
            error: function(data) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $('.alert').empty().addClass('show');
                    $.each(errors, function(key, value) {
                        // console.log(key + " " + value);
                        $('.alert').append(value + "<p/>");

                    });
                }
            }
        });
    }
</script>
