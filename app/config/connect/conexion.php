<?php
    namespace app\config\connect;
    use PDO;
    use PDOException; 

    abstract class conexion {

        // Atributos de la clase
        private $conex;

        public function __construct() {
            // Llamar al método para establecer la conexión a la base de datos
            $this->getConnection();
        }

        // metodo para conectar a la base de datos
        protected function getConnection(): PDO {

            // Manejo de excepciones para la conexión a la base de datos
            try {

                // Crear una nueva conexión PDO
                $this->conex = new PDO("mysql: host=localhost; dbname=userdb", "root", "");
                
                // Establecer el modo de error de PDO a excepción
                $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            } catch (PDOException $e) {

                // Si hay un error, se lanza una excepción y se muestra un mensaje de error
                die('ERROR DE CONEXIÓN: No se ha podido conectar con la base de datos. ' . $e->getMessage());
            }

            // Retornar la conexión establecida
            return $this->conex;
        }
    }

?>