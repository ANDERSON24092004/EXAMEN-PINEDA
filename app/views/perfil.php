<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="app\assets\css\perfil.css">
</head>

<body>

    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
                <div class="contenedor">
                    <div class="card">
                        <div class="card-header">
                            <img src="app/assets/img/default-profile.png" class="rounded-circle mb-3" alt="Foto de perfil">
                        </div>
                        <div class="card-header text-center">
                            <h4 class="name"></h4>
                            <small class="Email"></small>
                        </div>
                        <div class="card-body">
                            <p><strong>Teléfono:</strong> <?php echo $_SESSION['telefono'] ?></p>
                            <p><strong>Ciudad:</strong> <?php echo $_SESSION['ciudad'] ?></p>
                            <p><strong>Rol:</strong> <?php echo $_SESSION['rol'] ?></p>
                        </div>
                        <div class="btns">
                            <div class="d-flex justify-content-center gap-2 mb-2">
                                <button value="<?php echo $_SESSION['cedula'] ?>" type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                                    <i class="fas fa-user-edit me-2"></i> Editar Perfil
                                </button>
                                <button value="<?php echo $_SESSION['cedula'] ?>" type="button" class="btn btn-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalActualizarClave">
                                    <i class="fas fa-key me-2"></i> Actualizar Contraseña
                                </button>
                            </div>
                            <!-- Modal Actualizar Contraseña -->
                            <div class="modal fade" id="modalActualizarClave" tabindex="-1" aria-labelledby="modalActualizarClaveLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalActualizarClaveLabel">Actualizar Contraseña</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <form method="POST" action="" id="formActualizarClave">
                                            <div class="modal-body">
                                                <!-- Campo oculto para username por accesibilidad -->
                                                <div class="form-group mb-2">
                                                    <label for="nuevaClave">Nueva contraseña:</label>
                                                    <input type="password" class="form-control" id="nuevaClave" name="nuevaClave" required autocomplete="new-password">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="confirmarClave">Confirmar contraseña:</label>
                                                    <input type="password" class="form-control" id="confirmarClave" name="confirmarClave" required autocomplete="new-password">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i> Guardar Contraseña
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i> Cerrar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div class="btn-exit">
                        <div class="btn-exit">
                            <form method="post">
                                <button type="submit" name="logout" class="btn btn-danger w-100 mb-3">
                                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                    
                        <div class="card">
                            <div class="mb-3 text-start">
                                <button id="btn-registrar" class="btn btn-primary mb-3">
                                    <i class="fas fa-user-plus me-2"></i> Nuevo Usuario
                                </button>
                            </div>
                            <table id="userTable">
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar usuario</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" id="formularioP">
                                            <input type="hidden" id="update" name="update" value="0">
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
                                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad:</label>
                                                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="estado">Estado:</label>
                                                <select class="form-control" id="estado" name="estado" required>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="rol">Rol:</label>
                                                <input type="text" class="form-control" id="rol" name="rol" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="guardar-registro">
                                            <i class="fas fa-save me-2"></i> <span id="texto-guardar">Registrar</span>
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i> Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Modal Editar Perfil -->
                    <div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditarPerfilLabel">Editar Perfil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <form method="POST" action="" id="formEditarPerfil">
                                    <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label for="editarNombre">Nombre:</label>
                                            <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="editarApellido">Apellido:</label>
                                            <input type="text" class="form-control" id="editarApellido" name="apellido" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="editarCorreo">Correo:</label>
                                            <input type="email" class="form-control" id="editarCorreo" name="correo" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="editarTelefono">Teléfono:</label>
                                            <input type="text" class="form-control" id="editarTelefono" name="telefono" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="editarCiudad">Ciudad:</label>
                                            <input type="text" class="form-control" id="editarCiudad" name="ciudad" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i> Guardar Cambios
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i> Cerrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-2.3.1/datatables.min.js"></script>
        <script src="app/assets/js/ajax.js"></script>
        <script src="app/assets/js/datatable.js"></script>
        <script src="app/assets/js/perfil.js"></script>
        

</body>

</html>