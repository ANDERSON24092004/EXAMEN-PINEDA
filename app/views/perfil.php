<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_BASE ?>app\assets\css\sweetalert2.min.css">
    <link rel="stylesheet" href="app\assets\css\perfil.css">
</head>

<body>

    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <div class="contenedor">

                <!-- Seccion del propio perfil -->
                <div class="card">
                    <div class="card-header">
                        <img src="app/assets/img/default.png" class="rounded-circle mb-3" alt="Foto de perfil">
                    </div>
                    <div class="card-header text-center">
                        <h4 class="name"></h4>
                        <small class="Email"></small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" class='rol_inicio_sesion' value="<?php echo $_SESSION['rol'] ?>">
                            <?php if($_SESSION['rol']==1){$rol='Administrador';}else{$rol='Usuario';}?>
                            <div class="col-3"><p><strong>Cédula:</strong> <?php echo $_SESSION['cedula'] ?></p></div>
                            <div class="col-3"><p><strong>Nombre:</strong> <?php echo $_SESSION['nombre'] ?></p></div>
                            <div class="col-3"><p><strong>Apellido:</strong> <?php echo $_SESSION['apellido'] ?></p></div>
                            <div class="col-3"><p><strong>Teléfono:</strong> <?php echo $_SESSION['telefono'] ?></p></div>
                            <div class="col-3"><p><strong>Correo:</strong> <?php echo $_SESSION['correo'] ?></p></div>
                            <div class="col-3"><p><strong>Ciudad:</strong> <?php echo $_SESSION['ciudad'] ?></p></div>
                            <div class="col-3"><p><strong>Rol:</strong> <?php echo $rol ?></p></div>
                        </div>
                    </div>
                    <div class="btns">
                        <div class="d-flex justify-content-center gap-2 mb-2">
                            <button value="<?php echo $_SESSION['cedula'] ?>" type="button" class="botonActualizar btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                                <i class="fas fa-user-edit me-2"></i> Editar Perfil
                            </button>
                        </div>
                    </div class="btn-exit">
                    <div class="btn-exit">
                        <button type="submit" class="btn-cerrar-sesion btn btn-danger w-100 mb-3">
                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                        </button>
                    </div>
                </div>

                <!-- Tabla de registros -->
                <div class="card">
                    <?php if($_SESSION['rol']==1){ ?>
                    
                    <div class="mb-3 text-start">
                        <button id="btn-registrar" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                    
                    <?php }?>
                </div>

                <!-- Modal Registrar Usuarios -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar usuario</h1>
                            </div>
                            <form method="POST" class="formulario" action="">
                                <div class="modal-body">
                                        <input type="hidden" name="accion" value="registrar">
                                        <div class="row g-3">
                                            <div class="form-group col-12">
                                                <label for="cedula">Cédula:</label>
                                                <input type="number" class="form-control" name="cedula" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" name="nombre" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="apellido">Apellido:</label>
                                                <input type="text" class="form-control" name="apellido" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="numero">Número de Teléfono:</label>
                                                <input type="text" class="form-control" name="telefono" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="estado">Estado:</label>
                                                <select class="form-control" name="estado" required>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="numero">Correo:</label>
                                                <input type="text" class="form-control" name="correo" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="ciudad">Ciudad:</label>
                                                <input type="text" class="form-control" name="ciudad" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="rol">Rol:</label>
                                                <select class="form-control" name="rol" required>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Usuario</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="nuevaClave">Contraseña:</label>
                                                <input type="password" class="form-control" name="clave1" required autocomplete="new-password">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="confirmarClave">Confirmar contraseña:</label>
                                                <input type="password" class="form-control" name="clave2" required autocomplete="new-password">
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="guardar-registro">
                                        <i class="fas fa-save me-2"></i> <span id="texto-guardar">Registrar</span>
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-2"></i> Cerrar
                                    </button>
                                </div>
                            </form>
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
                            <form class="formulario" method="POST" action="">
                                <div class="modal-body">
                                    
                                    <input type="hidden" name="accion" value="actualizar">
                                    <input type="hidden" name="cedula">

                                    <div class="row g-3">
                                        <div class="form-group col-6">
                                            <label for="nombre">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="apellido">Apellido:</label>
                                            <input type="text" class="form-control" name="apellido" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="numero">Número de Teléfono:</label>
                                            <input type="text" class="form-control" name="telefono" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="numero">Correo:</label>
                                            <input type="text" class="form-control" name="correo" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="ciudad">Ciudad:</label>
                                            <input type="text" class="form-control" name="ciudad" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="rol">Rol:</label>
                                            <select class="form-control" name="rol" required>
                                                <option value="1">Administrador</option>
                                                <option value="2">Usuario</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nuevaClave">Contraseña:</label>
                                            <input type="password" class="form-control" name="clave1" placeholder="OPCIONAL">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="confirmarClave">Confirmar contraseña:</label>
                                            <input type="password" class="form-control" name="clave2" placeholder="OPCIONAL">
                                        </div>
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
        <script src="app/assets/js/sweetalert2.all.min.js"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-2.3.1/datatables.min.js"></script>
        <script src="app/assets/js/ajax.js"></script>
        <script src="app/assets/js/datatable.js"></script>

</body>

</html>