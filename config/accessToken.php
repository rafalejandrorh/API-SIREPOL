<?php 

require_once('Constantes.php');
require_once('vendor/autoload.php');
use Firebase\JWT\JWT;

class Token
{
    static public function generarToken($ministerio, $institucion, $dependencia, $dias)
    {
        date_default_timezone_set('America/Caracas');
        $time = time();
        $token = array(
            "iat" => $time, //Tiempo en que inicia el Token
            "exp" => $time + (60*60*24*$dias), //Tiempo de expiración del Token
            "data" => [
                "MinisterioAdscrito" => $ministerio,
                "Organismo" => $institucion,
                "Dependencia" => $dependencia
            ]
        );

        $prueba = $time + (60*60*24*$dias);

        $fecha_expire = date('Y-m-d H:i:s-Z', $prueba);

        $JWT = JWT::encode($token, "dfhsdfg32dfhcs4xgsrrsdry46", 'HS256');
        //$decode = JWT::decode($JWT, "dfhsdfg32dfhcs4xgsrrsdry46");
        return array("Token Codificado" => $fecha_expire);
    }

    static public function decodificarToken($token)
    {
        $JWT = JWT::decode($token, 'dfhsdfg32dfhcs4xgsrrsdry46', 'HS256');

        return array("Token Decodificado" => $JWT);
    }
}

?>