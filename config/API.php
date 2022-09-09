<?php

require_once('Constantes.php');

    class APIDB extends PDO{

        private $tipo_de_base = DB_TYPE_API;
        private $host = DB_HOST_API;
        private $nombre_de_base = DB_NAMEDB_API;
        private $usuario = DB_USER_API;
        private $clave = DB_PASSWORD_API;
        private $puerto = DB_PORT_API;
        private $options;

        public function __construct()
        {
            try{
                $this->options= [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
                parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};port={$this->puerto};host={$this->host}", $this->usuario, $this->clave, $this->options);
            } catch (PDOException $e) {
                echo '<br><br>Ha surgido un error y no se puede conectar a la base de datos. Detalle: <br><br>' . $e->getMessage().'<br><br>';
            }
        }

    }

?>
