<?php

require_once('config/Constantes.php');
require_once('config/API.php');

class TokenDAO 
{

    public $sirepol;

    public function __construct()
    {
        $this->api = new APIDB;
    }

    public function validarToken($token) 
    {

        $sql = "SELECT * FROM public.token_organismos WHERE token = '$token'";
        $query = $this->api->query($sql);
        if($query->rowCount() >= 1)
        {
            $token = $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $token = array(
                0 => array(
                    "No_Query" => 0
                )
            );
        }
        return $token;
    }

}

?>