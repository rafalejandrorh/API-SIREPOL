<?php

require_once('DAO/FuncionariosDAO.php');
require_once('DAO/TrazasDAO.php');
require_once('DTO/FuncionariosDTO.php');

class FuncionariosBLL
{

    public function __construct()
    {
        $this->FuncionariosDAO = new FuncionariosDAO();
        $this->FuncionariosDTO = new FuncionariosDTO();
        $this->TrazasDAO = new TrazasDAO();
    }

    public function Welcome()
    {
        return $this->FuncionariosDTO->okWelcome();
    }

    public function InvalidService($parametros)
    {
        return $this->FuncionariosDTO->errorCodeService($parametros);
    }

    public function Unauthorized()
    {
        return $this->FuncionariosDTO->errorUnauthorizedAction();
    }

    function ServicioConsultaFuncionario($parametros) 
    {
        $servicio = $parametros['Service'];

        if(date('Y-m-d') < Fecha_vencimiento_Token && $_GET['token'] == Token)
        {
            if($_GET['tipo'] != null && $_GET['valor'] != null && $_GET['ip'] != null && $_GET['mac'] != null && $_GET['ente'] != null && $_GET['usuario'] != null)
            {
                $datos = $this->FuncionariosDAO->ObtenerFuncionario($_GET['tipo'], $_GET['valor']);
                if(!empty($datos['funcionario'])){
                    $valor = $_GET['tipo'].':'.$_GET['valor'];
                    if($datos['funcionario'] != 'invalido')
                    {
                        $response = $this->FuncionariosDTO->okCodeService($servicio, $datos);
                    }else{
                        $datos = $parametros;
                        $response = $this->FuncionariosDTO->errorInvalidSearch($servicio, $datos);
                    }
                    $this->TrazasDAO->GuardarTraza($_GET['ip'], $_GET['mac'], $_GET['usuario'], $_GET['ente'], $servicio, json_encode($response, true), $valor, $_GET['token']);
                    return $response;
                }else{
                    return $this->FuncionariosDTO->errorCodeService($servicio);
                }
            }else{
                return $this->FuncionariosDTO->errorCodeRequest($servicio, $parametros);
            }
        }else if(date('Y-m-d') < Fecha_vencimiento_Token && $_GET['token'] != Token){
            return $this->FuncionariosDTO->errorCodeToken();
        }else if(date('Y-m-d') > Fecha_vencimiento_Token && $_GET['token'] == Token){
            return $this->FuncionariosDTO->errorCodeTokenExpire();
        }else if(date('Y-m-d') > Fecha_vencimiento_Token && $_GET['token'] == Token){
            return $this->FuncionariosDTO->errorNoToken();
        }     
    }

}
?>