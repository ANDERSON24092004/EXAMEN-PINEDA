<?php

use app\models\seccionModel;

$objetoSeccion = new seccionModel();

if (
    $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion'])
) {

    $accion = isset($_POST['accion']) ? $_POST['accion'] : "";
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : "";
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
    $correo = isset($_POST['correo']) ? $_POST['correo'] : "";
    $contrasena1 = isset($_POST['clave1']) ? $_POST['clave1'] : "";
    $contrasena2 = isset($_POST['clave2']) ? $_POST['clave2'] : "";
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : "";
    $rol = isset($_POST['rol']) ? $_POST['rol'] : "";

    switch ($accion) {
        case "listar":
            $resultado = $objetoSeccion->Seleccionar_Usuarios('completo');
            ob_clean();
            echo json_encode($resultado);
            exit();
        case "seleccionarUnRegistro":
            $resultado = $objetoSeccion->Seleccionar_Usuarios('unoSolo',$cedula);
            ob_clean();
            echo json_encode($resultado);
            exit();
        case "registrar":
            $resultado = $objetoSeccion->Registrar_Usuarios($cedula,$nombre,$apellido,$telefono,$correo,$contrasena1,$contrasena2,$ciudad,$rol
            );
            ob_clean();
            echo json_encode($resultado);
            exit();
        case "actualizar":
            $resultado = $objetoSeccion->Actualizar_Usuarios($cedula,$nombre,$apellido,$telefono,$correo,$contrasena1,$contrasena2,$ciudad,$rol);
            ob_clean();
            echo json_encode($resultado);
            exit();
        case "eliminar":
            $resultado = $objetoSeccion->Eliminar_Usuarios($cedula);
            ob_clean();
            echo json_encode($resultado);
            exit();
        case "iniciarSesion":
            $resultado = $objetoSeccion->Iniciar_Secion($correo, $contrasena1);
            ob_clean();
            echo json_encode($resultado);
            exit();
        case "cerrarSesion":
            $resultado = $objetoSeccion->Cerrar_Sesion();
            ob_clean();
            echo json_encode($resultado);
            exit();
        default:
            echo json_encode(["error" => "Acción no reconocida"]);
            exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["type"])) {

    if ($_GET['type'] == 'login') {
        require_once "app/views/login.php";
    } elseif ($_GET['type'] == 'perfil') {
        require_once "app/views/perfil.php";
    } else {
        require_once "app/views/login.php";
    }
} else {
    echo "Error: Tipo de vista no válida.";
}
