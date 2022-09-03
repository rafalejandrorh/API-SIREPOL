<?php

require_once('Constantes.php');

    class TrazasDB extends PDO{

        private $tipo_de_base = DB_TYPE_TRAZAS;
        private $host = DB_HOST_TRAZAS;
        private $nombre_de_base = DB_NAMEDB_TRAZAS;
        private $usuario = DB_USER_TRAZAS;
        private $clave = DB_PASSWORD_TRAZAS;
        private $puerto = DB_PORT_TRAZAS;
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
