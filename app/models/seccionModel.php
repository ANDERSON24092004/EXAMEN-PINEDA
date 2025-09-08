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

    //MÉTODOS PÚBLICOS PARA LA ENCAPSULACIÓN
    public function Iniciar_Secion($correo, $contrasena)
    {

        $FI = false;
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $correo)) {
            $campo = 'correo';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$%]{3,30}$/", $contrasena)) {
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
    public function Cerrar_Sesion(){
        return $this->cerrarSesion();
    }
    public function Seleccionar_Usuarios($tipo,$cedula = null)
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
            return $this->seleccionarUsuarios($tipo);
        }
    }
    public function Registrar_Usuarios($cedula, $nombre, $apellido, $telefono, $correo, $contrasena1, $contrasena2, $ciudad, $rol)
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
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena1)) {
            $campo = 'contraseña';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena2)) {
            $campo = 'confirmación de contraseña';
            $FI = true;
        }
        if ($contrasena1 != $contrasena2) {
            $campo = 'confirmación de contraseña';
            $FI = true;
        }
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $ciudad)) {
            $campo = 'ciudad';
            $FI = true;
        }
        if (!preg_match("/^\d{1}$/", $rol)) {
            $campo = 'rol';
            $FI = true;
        }

        $consulta=$this->seleccionarUsuarios($this->cedula);
        if(isset($consulta['cedula'])){
            $alerta = [
                "icono" => "error",
                "tipo" => "simple",
                "titulo" => "Cédula registrada",
                "texto" => "La cédula que está introduciendo ya se encuentra registrada",
            ];
            return $alerta;
            exit();
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
            $this->contrasena = $contrasena1;
            $this->ciudad = $ciudad;
            $this->rol = $rol;

            return $this->registrarUsuarios();
        }
    }
    public function Actualizar_Usuarios($cedula, $nombre, $apellido, $telefono, $correo, $contrasena1, $contrasena2, $ciudad, $rol)
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
        if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ]{3,30}$/", $ciudad)) {
            $campo = 'ciudad';
            $FI = true;
        }
        if (!preg_match("/^\d{1}$/", $rol)) {
            $campo = 'rol';
            $FI = true;
        }
        if($contrasena1 != ''){
            if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena1)) {
                $campo = 'contraseña';
                $FI = true;
            }
            if (!preg_match("/^[a-zA-ZáéíóúüÁÉÍÓÚñÑ0-9*.$]{3,30}$/", $contrasena2)) {
                $campo = 'confirmación de contraseña';
                $FI = true;
            }
            if ($contrasena1 != $contrasena2) {
                $campo = 'confirmación de contraseña';
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
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->contrasena = $contrasena1;
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

        if($this->cedula==$_SESSION['cedula']){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Usuario inválido",
                "texto" => "No puede eliminar su propio usuario",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
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
    private function seleccionarUsuarios($tipo)
    {

        if($tipo=='eliminados'){
            $consulta = $this->conex->prepare("SELECT * FROM `usuarios` WHERE `cedula`= :cedula AND estado = 0");
            $consulta->bindParam(':cedula', $this->cedula);
        }elseif ($this->cedula != null) {
            $consulta = $this->conex->prepare("SELECT * FROM `usuarios` WHERE `cedula`= :cedula AND estado != 0");
            $consulta->bindParam(':cedula', $this->cedula);
        } else {
            $consulta = $this->conex->prepare("SELECT * FROM `usuarios` WHERE `cedula`!= :cedula AND estado != 0");
            $consulta->bindParam(':cedula', $_SESSION['cedula']);
        }

        $consulta->execute();
        if($consulta->rowCount()==0){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Usuario no encontrado",
                "texto" => "El usuario no ha podido ser encontrado",
                "icono" => "error",
            ];
            return ($alerta);
            exit();
        }elseif($this->cedula != null){
            $usuarios = $consulta->fetch(PDO::FETCH_ASSOC);
        }else{
            $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        return $usuarios;
    }
    private function registrarUsuarios()
    {
        try {

            //Aqui diferenciamos si la cedula esta o no en la BD
            $usuarioregistrado=$this->seleccionarUsuarios('eliminados', $this->cedula);
            if(isset($usuarioregistrado['cedula'])){
                $sql = "UPDATE usuarios SET 
                cedula= :cedula, nombre = :nombre, apellido = :apellido,
                telefono = :telefono, correo = :correo, clave= :clave,
                ciudad = :ciudad, rol = :rol, estado= :estado WHERE cedula = :cedula";
            }else{
                $sql = "INSERT INTO usuarios (cedula, nombre, apellido, 
                telefono, correo, clave, ciudad, rol, estado) VALUES (:cedula, 
                :nombre, :apellido, :telefono, :correo, :clave, :ciudad, :rol, 
                :estado)";
            }

            $consulta = $this->conex->prepare($sql);
            $estado=1;

            $consulta->bindParam(":cedula", $this->cedula);
            $consulta->bindParam(":nombre", $this->nombre);
            $consulta->bindParam(":apellido", $this->apellido);
            $consulta->bindParam(":telefono", $this->telefono);
            $consulta->bindParam(":correo", $this->correo);
            $consulta->bindParam(":clave", $this->contrasena);
            $consulta->bindParam(":ciudad", $this->ciudad);
            $consulta->bindParam(":rol", $this->rol);
            $consulta->bindParam(":estado", $estado);

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
                    "tipo" => "limpiar",
                    "titulo" => "Usuarios registrado exitosamente",
                    "texto" => "El usuario ha sido registrado con éxito",
                    "icono" => "success",
                ];
                return ($alerta);
                exit();
            }
        } catch (\PDOException $e) {
            return ["Mensaje" => "Error en la base de datos: " . $e->getMessage(). "En la linea: ". $e->getLine()];
        }
    }
    private function actualizarUsuarios()
    {
        try {
            $sql = "UPDATE usuarios SET 
            nombre = :nombre, apellido = :apellido, telefono = :telefono, 
            correo = :correo, ciudad = :ciudad, rol = :rol ";

            if($this->contrasena != ''){
                $sql.=", clave = :contrasena ";
            }
            $sql.="WHERE cedula = :cedula";

            return $sql;

            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(":cedula", $this->cedula);
            $consulta->bindParam(":nombre", $this->nombre);
            $consulta->bindParam(":apellido", $this->apellido);
            $consulta->bindParam(":telefono", $this->telefono);
            $consulta->bindParam(":correo", $this->correo);
            $consulta->bindParam(":ciudad", $this->ciudad);
            $consulta->bindParam(":rol", $this->rol);

            if($this->contrasena!=''){
                $consulta->bindParam(":contrasena", $this->contrasena);
            }

            // return $consulta;
            $consulta->execute();
            if ($consulta->rowCount() == 0) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Usuario no actualizado",
                    "texto" => "No se realizaron cambios al usuario",
                    "icono" => "warning",
                ];
                return ($alerta);
                exit();
            } else {

                if($this->cedula == $_SESSION['cedula']){
                    /*Reasignamos las variables de sesión*/
                    $_SESSION['cedula'] = $this->cedula;
                    $_SESSION['nombre'] = $this->nombre;
                    $_SESSION['apellido'] = $this->apellido;
                    $_SESSION['correo'] = $this->correo;
                    $_SESSION['telefono'] = $this->telefono;
                    $_SESSION['ciudad'] = $this->ciudad;
                    $_SESSION['clave'] = $this->contrasena;
                    $_SESSION['rol'] = $this->rol;
                }

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
            $sql = "UPDATE usuarios SET estado = :estado WHERE cedula = :cedula";
            $consulta = $this->conex->prepare($sql);

            $estado=0;
            $consulta->bindParam(":estado", $estado);
            $consulta->bindParam(":cedula", $this->cedula);

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
                    "titulo" => "Usuario Eliminado",
                    "texto" => "El usuario ha sido eliminado con éxito",
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

                    $alerta=[
                        "tipo" => "redireccionar",
                        "url" => URL_BASE.'?url=seccion&type=perfil'
                    ];
                    return $alerta;
                    exit();
                }else{
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Usuario o contraseña incorrectos",
                        "texto" => "El usuario o la contraseña son incorrectos, por favor verifique e intente de nuevo",
                        "icono" => "error"
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
    private function cerrarSesion(){
        session_destroy();
        $alerta=[
            "tipo" => "redireccionar",
            "url" => URL_BASE."?url=seccion&type=login"
        ];
        return $alerta;
        exit();
    }
}
