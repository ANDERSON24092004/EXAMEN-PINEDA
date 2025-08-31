$(document).ready(function () {
    // Editar perfil
    $('#formEditarPerfil').on('submit', function (e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        var dataObj = {};
        datos.forEach(function(item){
            dataObj[item.name] = item.value;
        });
        dataObj.updatePerfil = true;
        $.ajax({
            url: 'index.php?url=seccion&type=perfil',
            method: 'POST',
            dataType: 'json',
            data: dataObj,
            success: function (response) {
                if (response.success) {
                    Swal.fire('¡Guardado!', response.message || 'Perfil actualizado correctamente.', 'success');
                    setTimeout(function(){ location.reload(); }, 1200);
                } else {
                    Swal.fire('Error', response.message || 'No se pudo actualizar el perfil.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
            }
        });
    });

    // Actualizar contraseña
    $('#formActualizarClave').on('submit', function (e) {
        e.preventDefault();
        const nuevaClave = $('#nuevaClave').val();
        const confirmarClave = $('#confirmarClave').val();
        if (nuevaClave !== confirmarClave) {
            Swal.fire('Error', 'Las contraseñas no coinciden.', 'error');
            return;
        }
        $.ajax({
            url: 'index.php?url=seccion&type=perfil',
            method: 'POST',
            dataType: 'json',
            data: {
                actualizarClave: true,
                clave: nuevaClave
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire('¡Guardado!', response.message || 'Contraseña actualizada correctamente.', 'success');
                    setTimeout(function(){ location.reload(); }, 1200);
                } else {
                    Swal.fire('Error', response.message || 'No se pudo actualizar la contraseña.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
            }
        });
    });
});
