<?php

require_once('Constantes.php');

    class SirepolDB extends PDO{

        private $tipo_de_base = DB_TYPE_SIREPOL;
        private $host = DB_HOST_SIREPOL;
        private $nombre_de_base = DB_NAMEDB_SIREPOL;
        private $usuario = DB_USER_SIREPOL;
        private $clave = DB_PASSWORD_SIREPOL;
        private $puerto = DB_PORT_SIREPOL;
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
