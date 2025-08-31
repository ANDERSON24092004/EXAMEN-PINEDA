$(document).ready(async function () {
    // AJAX para editar perfil desde el modal
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
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 9000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    console.log('user.js cargado');
    const tblPaciente = $('#userTable').DataTable({
        ajax: {
            url: 'index.php?url=seccion&type=perfil',
            method: 'POST',
                data: {
                    getUsers: true
                },
            dataSrc: ''
        },
        columns: [
            { data: 'cedula' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'Teléfono' },
            { data: 'ciudad' },
            { data: 'Estado' },
            { data: 'Rol' },
            {
                data: null, render: (data) => {
                    const btnEditar = `<button value="${data.cedula}" type="button" class="btn btn-primary btn-sm btn-modificar text-center" title="Editar usuario" style="width:90px;display:flex;flex-direction:column;align-items:center;justify-content:center;"><i class="fas fa-pen-to-square fa-lg mb-1"></i><span style="font-size:15px;">Editar</span></button>`;
                    const btnEliminar = `<button value="${data.cedula}" type="button" class="btn btn-danger btn-sm btn-eliminar text-center" title="Eliminar usuario" style="width:90px;display:flex;flex-direction:column;align-items:center;justify-content:center;"><i class="fas fa-trash fa-lg mb-1"></i><span style="font-size:15px;">Eliminar</span></button>`;
                    return `<div class="d-flex flex-row gap-2 justify-content-center">${btnEditar}${btnEliminar}</div>`;
                }
            }
        ],
        autoWidth: false,
        "columnDefs": [
            { targets: [0, 1, 2, 3, 4, 5, 6], className: 'tabla' },
            { orderable: false, className: 'acciones', targets: [4] }
        ],
        "language": {
            url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        }
    });

    $(document).on('click', '.btn-eliminar', async function () {
        const cedula = this.value;

        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'index.php?url=seccion&type=perfil',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        cedula: cedula,
                        deleteUser: true
                    },
                    success: function (response) {
                        Swal.fire(
                            '¡Eliminado!',
                            response.message,
                            'success'
                        );
                        tblPaciente.ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire(
                            'Error',
                            "Error al eliminar usuario: ",
                            'error'
                        );
                    }
                });
            }
        });
    });

    $(document).on('click', '#btn-registrar', function () {
        $('#exampleModalLabel').text('Registrar usuario');
        $('#formularioP')[0].reset();
        $('#guardar-registro').text('Registrar');
        $('#cedula').prop('readonly', false);
        accion = 0;
        $('#exampleModal').modal('show');

    });
    var accion = 0;
    $(document).on('submit', '#formularioP', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
            if (accion == 0) {
                // Enviar los datos que espera el backend para guardar usuario
                formData.append('cedula', $('#cedula').val());
                formData.append('nombre', $('#nombre').val());
                formData.append('apellido', $('#apellido').val());
                formData.append('Teléfono', $('#numero').val());
                formData.append('ciudad', $('#ciudad').val());
                formData.append('estado', 1); // Puedes ajustar el estado según tu lógica
                formData.append('rol', $('#rol').val());
            } else {
                // Enviar los datos que espera el backend para actualizar usuario
                formData.append('cedula', $('#cedula').val());
                formData.append('nombre', $('#nombre').val());
                formData.append('apellido', $('#apellido').val());
                formData.append('Teléfono', $('#numero').val());
                formData.append('ciudad', $('#ciudad').val());
                formData.append('estado', 1); // Puedes ajustar el estado según tu lógica
                formData.append('rol', $('#rol').val());
                formData.append('update', true);
            }

        $.ajax({
            url: 'index.php?url=seccion&type=perfil',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#exampleModal').modal('hide');
                tblPaciente.ajax.reload();
            },
            error: function (xhr, status, error) {
                Swal.fire(
                    'Error',
                    "Error al guardar usuario: " + error,
                    'error'
                );
            }
        });
    });

    $(document).on('click', '.btn-modificar', function () {
        const cedula = this.value;
        accion = 1;

            $.ajax({
                url: 'index.php?url=seccion&type=perfil',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    cedula: cedula,
                    getuser: true
                },
                success: function (paciente) {
                        console.log(paciente);
                    $('#exampleModalLabel').text('Editar usuario');
                    $('#cedula').val(paciente.cedula);
                    $('#nombre').val(paciente.nombre);
                    $('#apellido').val(paciente.apellido);
                    $('#numero').val(paciente['Teléfono']);
                    $('#ciudad').val(paciente.ciudad);
                    $('#rol').val(paciente.Rol);
                    $('#cedula').prop('readonly', true);
                    $('#guardar-registro').text('Modificar');
                    $('#exampleModal').modal('show');
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        'Error',
                        "Error al obtener datos del usuario: " + error,
                        'error'
                    );
                }
            });
    });
});