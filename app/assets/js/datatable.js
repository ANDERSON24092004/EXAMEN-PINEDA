$(document).ready(function () {


    // Accesibilidad: mover foco al botón 'Nuevo' al cerrar el modal
    $('#exampleModal').on('hidden.bs.modal', function () {
        $('#btn-registrar').focus();
    });
    // DataTables config
    const tblPaciente = $('#userTable').DataTable({
        ajax: {
            url: `${rutaAbsoluta}?url=seccion`,
            method: 'POST',
            data: { 'accion': 'listar' },
            dataSrc: ''
        },
        columns: [
            { data: 'cedula' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'telefono' },
            { data: 'ciudad' },
            { data: 'estado' },
            { data: 'rol' },
            {
                data: null,
                render: function (data, type, row) {
                    const btnEditar = `<button value="${data.cedula}" type="button" class="btn btn-primary btn-sm ms-2 btn-modificar" title="Editar usuario"><i class="fas fa-edit me-1"></i> Editar</button>`;
                    const btnEliminar = `<button value="${data.cedula}" type="button" class="btn btn-danger btn-sm ms-2 btn-eliminar" title="Eliminar usuario"><i class="fas fa-trash-alt me-1"></i> Eliminar</button>`;
                    return `<div class="d-flex">${btnEditar} ${btnEliminar}</div>`;
                }
            }
        ],
        autoWidth: false,
        columnDefs: [
            { targets: [0, 1, 2, 3, 4, 5, 6], className: 'tabla' },
            { orderable: false, className: 'acciones', targets: [4] }
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        }
    });

    // Eliminar usuario
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
                        Swal.fire('¡Eliminado!', response.message, 'success');
                        tblPaciente.ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire('Error', "Error al eliminar usuario: ", 'error');
                    }
                });
            }
        });
    });

    // Abrir modal de registro
    $(document).on('click', '#btn-registrar', function () {
        $('#exampleModalLabel').text('Registrar usuario');
        $('#formularioP')[0].reset();
        $('#texto-guardar').text('Registrar');
        $('#cedula').prop('readonly', false);
        $('#update').val(0);
        accion = 0;
        $('#exampleModal').modal('show');
    });

    // Abrir modal de modificar usuario
    $(document).on('click', '.btn-modificar', function () {
        const cedula = $(this).val();
        // Limpiar el formulario antes de mostrar
        $('#formularioP')[0].reset();
        $.ajax({
            url: 'index.php?url=seccion&type=perfil',
            method: 'POST',
            dataType: 'JSON',
            data: { getuser: true, cedula: cedula },
            success: function (paciente) {
                if (!paciente || !paciente.cedula) {
                    Swal.fire('Error', 'No se encontró el usuario.', 'error');
                    return;
                }
                $('#cedula').val(paciente.cedula);
                $('#nombre').val(paciente.nombre);
                $('#apellido').val(paciente.apellido);
                $('#telefono').val(paciente.telefono);
                $('#ciudad').val(paciente.ciudad);
                $('#estado').val(paciente.Estado == 1 ? '1' : '0');
                $('#rol').val(paciente.rol);
                $('#cedula').prop('readonly', true);
                $('#update').val(1);
                $('#texto-guardar').text('Modificar');
                $('#exampleModalLabel').text('Modificar usuario');
                $('#exampleModal').modal('show');
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', "Error al obtener datos del usuario: " + error, 'error');
            }
        });
    });

    // Registrar o modificar usuario
    var accion = 0;
    $(document).on('submit', '#formularioP', function (e) {
        e.preventDefault();
        var datos = $(this).serialize();
        $.ajax({
            url: 'index.php?url=seccion&type=perfil',
            method: 'POST',
            data: datos,
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
                Swal.fire('Error', "Error al guardar usuario: " + error, 'error');
            }
        });
    });
});
