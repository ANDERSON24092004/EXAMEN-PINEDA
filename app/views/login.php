<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de inicio de seccion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL_BASE ?>app\assets\css\sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo URL_BASE ?>app\assets\css\login.css">
</head>

<body class="body-bg">
    <div class="login-card">

        <div class="heading-section">
            <h1 class="main-heading">
                Login de <br><span class="highlight-text">usuario</span>
            </h1>
            <p class="sub-heading">Ingresa tus datos para iniciar sesión</p>
        </div>

        <!-- Login Form -->
        <form method="post" class="formulario login-form" action="<?php echo URL_BASE ?>?url=seccion&type=perfil">
            
            <input type="hidden" name="accion" value="iniciarSesion">
            
            <!-- Email Input Group -->
            <div class="form-group">
                <label for="email" class="form-label">Correo</label>
                <div class="input-container">
                    <input type="email" class="form-input" name="correo" placeholder="correo@ejemplo.com" required>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
            <!-- Password Input Group -->
            <div class="form-group">
                <label for="password_user" class="form-label">Contraseña</label>
                <div class="input-container">
                    <input input type="password" class="form-input" name="clave1" placeholder="Contraseña" required>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-button">
                Ingresar
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app/assets/js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.3.1/datatables.min.js"></script>
    <script src="<?php echo URL_BASE ?>app/assets/js/ajax.js"></script>
    <script src="app/assets/js/datatable.js"></script>
</body>

</html>