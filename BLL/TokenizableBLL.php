<?php

require_once ('../DAO/TokenDAO.php');


if(isset($_POST['generar']))
{
    $token = new Token();
    $generar = $token->g3n3r4t10n();
}

?>