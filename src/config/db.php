<?php

    class db{

        private $host = "localhost";
        private $usuario = "root";
        private $password = "";
        private $base = "bdclientes";

        //conectar a la bases de datos


        public function conectar(){

            $conexion_mysql = "mysql:host=$this->host;dbname=$this->base";
            $conexionDB = new PDO($conexion_mysql, $this->usuario, $this->password);
            $conexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //esta linea arregla los datos de codificacion utf8
            $conexionDB -> exec("set names utf8");

            return $conexionDB;
        
        }

    }


?>