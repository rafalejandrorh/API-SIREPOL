<?php

require_once('config/Constantes.php');
require_once('config/Trazas.php');

class TrazasDAO 
{

    public $trazas;

    public function __construct()
    {   
        $this->trazas = new TrazasDB;
    }

    public function GuardarTraza($ip, $mac, $cedula_solicitante, $ente_solicitante, $accion, $json, $valor, $token) 
    {
        $sql = "INSERT INTO auditoria_mppd (ip, mac, cedula_solicitante, ente_solicitante, fecha_solicitud, accion, json, valor_consulta, token)
                VALUES ('$ip', '$mac', '$cedula_solicitante', '$ente_solicitante', 'NOW()', '$accion', '$json', '$valor', '$token')";
        $this->trazas->query($sql);
    }

}

?>