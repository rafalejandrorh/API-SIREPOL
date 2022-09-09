<?php

require_once('config/Constantes.php');
require_once('config/Trazas.php');
require_once('config/API.php');

class TrazasDAO 
{

    public $trazas;

    public function __construct()
    {   
        $this->trazas = new TrazasDB;
        $this->traza = new APIDB;
    }

    public function GuardarTraza($ip, $mac, $usuario, $ente, $accion, $response, $request, $token) 
    {
        $sql = "INSERT INTO trazas_api (ip, mac, usuario, ente, fecha_request, action, response, request, token)
                VALUES ('$ip', '$mac', '$usuario', '$ente', NOW(), '$accion', '$response', '$request', '$token')";
        $this->traza->query($sql);
    }

}

?>