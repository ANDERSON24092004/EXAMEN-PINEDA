<?php

namespace app\controllers;

    class frontController {
        private $dir;
        private $controller;        
        private $url;

        public function __construct() {

            if (isset($_REQUEST["url"])) {
                $this->url = $_REQUEST["url"];
                $this->dir = 'app/controllers/';
                $this->controller = '.php';
                $this->getURL();
            } 
            else {
                echo "Error 404: la url no existe";
                die("<script>location='?url=seccion&type=login'</script>");
            }
        }

        private function getURL() {            
            if(file_exists($this->dir . $this->url . $this->controller)) {
                require_once($this->dir . $this->url . $this->controller);
            } else {
                echo "<script>location='?url=seccion&type=login'</script>";
            }
        }

    }

?>