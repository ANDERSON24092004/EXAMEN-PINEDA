<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/brands.min.css" integrity="sha512-58P9Hy7II0YeXLv+iFiLCv1rtLW47xmiRpC1oFafeKNShp8V5bKV/ciVtYqbk2YfxXQMt58DjNfkXFOn62xE+g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-2">
        <button id="btn-registrar" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i> Nuevo Paciente
        </button>
        <h1>Lista de Pacientes</h1>
        <table id="PacienteTable">
            <thead>
                <tr style="margin-top: 10%;">
                    <th class="tabla">Cedula</th>
                    <th class="tabla">Nombre</th>
                    <th class="tabla">Apellido</th>
                    <th class="tabla">Teléfono</th>
                    <th class="tabla">Ciudad</th>
                    <th class="tabla">Estado</th>
                    <th class="tabla">Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="formularioP">
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <input type="number" class="form-control" id="cedula" name="cedula" required>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>

                        <div class="form-group">
                            <label for="numero">Número de Teléfono:</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>

                        <div class="form-group">
                            <label for="ciudad">ciudad:</label>
                            <input type="ciudad" class="form-control" id="ciudad" name="ciudad" required>
                        </div>

                        <div class="form-group">
                            <label for="rol">rol:</label>
                            <input type="rol" class="form-control" id="rol" name="rol" required>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="guardar-registro">
                        <i class="fas fa-save me-2"></i> Registrar
                    </button>
                    <a href="index.php?url=paciente&type=list" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i> Lista
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.3.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="app/assets/js/paciente.js"></script>
</body>

</html>