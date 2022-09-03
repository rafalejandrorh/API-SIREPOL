<?php

require_once('../config/Constantes.php');

class Token
{
    public function g3n3r4t10n()
    {
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        return $token;
    }
}

?>