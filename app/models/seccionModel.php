<?php

namespace app\models;

use app\config\connect\conexion;
use PDO;

class seccionModel extends conexion
{
    private $conex;
    private $cedula;
    private $nombre;
    private $apellido;
    private $telefono;
    private $correo;
    private $contrasena;
    private $ciudad;
    private $rol;

    public function __construct()
    {

        parent::__construct();
        $this->conex = $this->getConnection();
    }

    //METODOS PUBLICOS PARA LA ENCAPSULACIÓN
    public function Iniciar_Secion($correo, $contrasena)
    {
        $FI = false;
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $correo)) {
            $campo = 'correo';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena)) {
            $campo = 'contraseña';
            $FI = true;
        }

        if ($FI == true) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Campo de " . $campo . "no válido",
                "texto" => "El formato introducido en el campo de " . $campo . " no es válido, verifique e intente de nuevo",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
        } else {
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            return $this->iniciarSesion();
        }
    }
    public function Seleccionar_Usuarios($cedula = null)
    {

        $FI = false; //abreviado de "Formato Invalido"

        if ($cedula != null) {
            if (!preg_match("/^\d{7,9}$/", $cedula)) {
                $campo = 'cedula';
                $FI = true;
            }
        }

        if ($FI == true) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Campo de " . $campo . " no válido",
                "texto" => "El formato introducido en el campo de " . $campo . " no es válido, verifique e intente de nuevo",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
        } else {

            $this->cedula = $cedula;
            return $this->seleccionarUsuarios();
        }
    }
    public function Registrar_Usuarios($cedula, $nombre, $apellido, $telefono, $correo, $contrasena, $ciudad, $rol)
    {
        $FI = false; //abreviado de "Formato Invalido"

        if (!preg_match("/^\d{7,9}$/", $cedula)) {
            $campo = 'cedula';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $nombre)) {
            $campo = 'nombre';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $apellido)) {
            $campo = 'apellido';
            $FI = true;
        }
        if (!preg_match("/^\d{11}$/", $telefono)) {
            $campo = 'teléfono';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $correo)) {
            $campo = 'correo';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena)) {
            $campo = 'contraseña';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $ciudad)) {
            $campo = 'ciudad';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $rol)) {
            $campo = 'rol';
            $FI = true;
        }

        if ($FI == true) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Campo de " . $campo . "no válido",
                "texto" => "El formato introducido en el campo de " . $campo . " no es válido, verifique e intente de nuevo",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
        } else {
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->ciudad = $ciudad;
            $this->rol = $rol;

            return $this->registrarUsuarios();
        }
    }
    public function Actualizar_Usuarios($cedula, $nombre, $apellido, $telefono, $correo, $contrasena, $ciudad, $rol)
    {
        $FI = false; //abreviado de "Formato Invalido"

        if (!preg_match("/^\d{7,9}$/", $cedula)) {
            $campo = 'cedula';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $nombre)) {
            $campo = 'nombre';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $apellido)) {
            $campo = 'apellido';
            $FI = true;
        }
        if (!preg_match("/^\d{11}$/", $telefono)) {
            $campo = 'teléfono';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $correo)) {
            $campo = 'correo';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena)) {
            $campo = 'contraseña';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $ciudad)) {
            $campo = 'ciudad';
            $FI = true;
        }
        if (!preg_match("/^\d{11}$/", $rol)) {
            $campo = 'rol';
            $FI = true;
        }

        if ($FI == true) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Campo de " . $campo . "no válido",
                "texto" => "El formato introducido en el campo de " . $campo . " no es válido, verifique e intente de nuevo",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
        } else {

            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->ciudad = $ciudad;
            $this->rol = $rol;

            return $this->actualizarUsuarios();
        }
    }
    public function Eliminar_Usuarios($cedula)
    {
        $FI = false; //abreviado de "Formato Invalido"

        if (!preg_match("/^\d{7,9}$/", $cedula)) {
            $campo = 'cedula';
            $FI = true;
        }

        if ($FI == true) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Campo de " . $campo . "no válido",
                "texto" => "El formato introducido en el campo de " . $campo . " no es válido, verifique e intente de nuevo",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
        } else {

            $this->cedula = $cedula;
            return $this->eliminarUsuarios();
        }
    }

    //PRIVADOS PARA EL MANEJO DE LA BD
    private function seleccionarUsuarios()
    {
        try {
            if ($this->cedula != null) {
                $consulta = $this->conex->prepare("SELECT * FROM `usuarios` WHERE `cedula`= :cedula");
                $consulta->bindParam(':correo', $this->correo);
            } else {
                $consulta = $this->conex->prepare("SELECT * FROM `usuarios`");
            }

            $consulta->execute();
            $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch (\Exception $e) {
            return array("status" => "error", "message" => $e->getMessage());
        }
    }
    private function registrarUsuarios()
    {
        try {
            $sql = "INSERT INTO usuarios (cedula, nombre, apellido, telefono, correo, clave, ciudad, rol, estado) VALUES (:cedula, :nombre, :apellido, :telefono, :correo, :clave :ciudad, :rol, :estado)";

            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(":cedula", $this->cedula);
            $consulta->bindParam(":nombre", $this->nombre);
            $consulta->bindParam(":apellido", $this->apellido);
            $consulta->bindParam(":telefono", $this->telefono);
            $consulta->bindParam(":correo", $this->correo);
            $consulta->bindParam(":clave", $this->contrasena);
            $consulta->bindParam(":ciudad", $this->ciudad);
            $consulta->bindParam(":estado", 1);
            $consulta->bindParam(":rol", $this->rol);

            $consulta->execute();

            if ($consulta->rowCount() == 0) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuarios no registrado",
                    "texto" => "El usuario no ha podido ser registrado",
                    "icono" => "error",
                ];
                return ($alerta);
                exit();
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuarios registrado exitosamente",
                    "texto" => "El usuario ha sido registrado con éxito",
                    "icono" => "success",
                ];
                return ($alerta);
                exit();
            }
        } catch (\PDOException $e) {
            return ["Mensaje" => "Error en la base de datos: " . $e->getMessage()];
        }
    }
    
    private function actualizarUsuarios()
    {
        try {
            $sql = "UPDATE user SET 
            nombre = :nombre, apellido = :apellido, telefono = :telefono, 
            correo = :correo, clave = :contrasena, ciudad = :ciudad, 
            estado = :estado, rol = :rol WHERE cedula = :cedula";

            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(":cedula", $this->cedula);
            $consulta->bindParam(":nombre", $this->nombre);
            $consulta->bindParam(":apellido", $this->apellido);
            $consulta->bindParam(":telefono", $this->telefono);
            $consulta->bindParam(":correo", $this->correo);
            $consulta->bindParam(":clave", $this->contrasena);
            $consulta->bindParam(":ciudad", $this->ciudad);
            $consulta->bindParam(":estado", 1);
            $consulta->bindParam(":rol", $this->rol);

            $consulta->execute();
            if ($consulta->rowCount() == 0) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario no actualizado",
                    "texto" => "El usuario no pudo ser actualizado",
                    "icono" => "error",
                ];
                return ($alerta);
                exit();
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario actualizado",
                    "texto" => "El usuario ha sido actualizado con exito",
                    "icono" => "success",
                ];
                return ($alerta);
                exit();
            }
        } catch (\PDOException $e) {
            return ["success" => false, "message" => "Error en la base de datos: " . $e->getMessage()];
        }
    }
    private function eliminarUsuarios()
    {
        try {
            $sql = "UPDATE usuarios SET estado = 0 WHERE cedula = :cedula";
            $consulta = $this->conex->prepare($sql);
            $consulta->bindValue(1, $this->cedula);
            $consulta->execute();

            if ($consulta->rowCount() == 0) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario no eliminado",
                    "texto" => "El usuario no pudo ser eliminado",
                    "icono" => "error",
                ];
                return ($alerta);
                exit();
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario actualizado",
                    "texto" => "El usuario ha sido actualizado con éxito",
                    "icono" => "success",
                ];
                return ($alerta);
                exit();
            }
        } catch (\PDOException $e) {
            return ["success" => false, "message" => "Error en la base de datos: " . $e->getMessage()];
        }
    }
    private function iniciarSesion()
    {
        try {
            $consulta = $this->conex->prepare("SELECT * FROM `usuarios` WHERE estado = 1 AND `correo` = :correo");
            $consulta->bindParam(':correo', $this->correo);
            $consulta->execute();

            if ($consulta->rowCount() == 0) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario no encontrado",
                    "texto" => "El usuario no se encuentra registrado en la base de datos",
                    "icono" => "error",
                ];
                return ($alerta);
                exit();
            } else {
                $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            }

            if (isset($usuario['clave'])) {

                if (
                    $this->contrasena == $usuario["clave"] &&
                    $this->correo == $usuario['correo']
                ) {
                    /*Creamos las variables de sesión */
                    $_SESSION['cedula'] = $usuario['cedula'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['apellido'] = $usuario['apellido'];
                    $_SESSION['correo'] = $usuario['correo'];
                    $_SESSION['telefono'] = $usuario['telefono'];
                    $_SESSION['ciudad'] = $usuario['ciudad'];
                    $_SESSION['clave'] = $usuario['clave'];
                    $_SESSION['rol'] = $usuario['rol'];

                    //Alerta para el redireccionamiento
                    $alerta = [
                        "tipo" => "redireccionar",
                        "url" => URL_BASE . "?url=seccion&type=perfil"
                    ];

                    return $alerta;
                    exit();
                }
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario no encontrado",
                    "texto" => "El usuarios que ha intentado buscar no se encuentra en la base de datos",
                    "icono" => "error"
                ];
                return $alerta;
                exit();
            }
        } catch (\exception $error) {
            return $error;
        }
    }
}
