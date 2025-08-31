<?php
    require 'vendor/autoload.php';
    require 'app/config/const.php';
    use app\controllers\frontController;
    session_name('Examen_Pineda');
    session_start(); 
    $frontController = new frontController();
?>