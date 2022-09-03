<?php
// Se incluye las constantes
require_once('config/Constantes.php');

// Se incluye los BLL a los que se consulta
require_once('BLL/FuncionariosBLL.php');
require_once('BLL/ResennaBLL.php');

$FuncionariosBLL = new FuncionariosBLL();
$ResennaBLL = new ResennaBLL();

if($_SERVER['REQUEST_METHOD'] == "GET" && @$_GET['Service'] == ConsultaFuncionario){
        $response = $FuncionariosBLL->ServicioConsultaFuncionario($_GET);
        echo json_encode($response);
        header('Content-Type: application/json');
}else if($_SERVER['REQUEST_METHOD'] == "GET" && @$_GET['Service'] == ConsultaResennado){
        $response = $ResennaBLL->ServicioConsultaResennado($_GET);
        echo json_encode($response);
        header('Content-Type: application/json');
}else if($_SERVER['REQUEST_METHOD'] == "GET" && @$_GET['Service'] == ''){
        $response = $FuncionariosBLL->Welcome();
        echo json_encode($response);
        header('Content-Type: application/json');
}else if($_SERVER['REQUEST_METHOD'] != "GET"){
        $response = $FuncionariosBLL->Unauthorized();
        echo json_encode($response);
        header('Content-Type: application/json');
}else{
        $response = $FuncionariosBLL->InvalidService(@$_GET['Service']);
        echo json_encode($response);
        header('Content-Type: application/json');
}

?>