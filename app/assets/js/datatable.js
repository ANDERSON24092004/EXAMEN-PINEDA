$(document).ready(function () {
    // DataTables config
    instanciaTabla = $('#userTable').DataTable({
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
                    
                    const btnEditar = `
                    <button 
                    type="button" 
                    value="${data.cedula}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalEditarPerfil" 
                    class="botonActualizar btn btn-primary btn-sm ms-2 btn-modificar" 
                    title="Editar usuario">
                    <i class="fas fa-edit me-1"></i>
                    Editar
                    </button>`;

                    const btnEliminar = `
                    <button 
                    type="button" 
                    value="${data.cedula}" 
                    class="btn btn-danger btn-sm ms-2 btn-eliminar" 
                    title="Eliminar usuario">
                    <i class="fas fa-trash-alt me-1"></i> 
                    Eliminar
                    </button>`;
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
});
