<?php

require_once('DAO/ResennaDAO.php');
require_once('DAO/TrazasDAO.php');
require_once('DTO/ResennaDTO.php');

class ResennaBLL
{

    public function __construct()
    {
        $this->ResennaDAO = new ResennaDAO();
        $this->ResennaDTO = new ResennaDTO();
        $this->TrazasDAO = new TrazasDAO();
    }

    public function Welcome()
    {
        return $this->ResennaDTO->okWelcome();
    }

    public function Unauthorized()
    {
        return $this->ResennaDTO->errorUnauthorizedAction();
    }

    function ServicioConsultaResennado($parametros) 
    {
        $servicio = $parametros['Service'];

        if(date('Y-m-d') < Fecha_vencimiento_Token && $_GET['token'] == Token)
        {
            if($_GET['tipo'] != null && $_GET['valor'] != null && $_GET['ip'] != null && $_GET['mac'] != null && $_GET['ente'] != null && $_GET['usuario'] != null)
            {
                $datos = $this->ResennaDAO->ObtenerResennado($_GET['tipo'], $_GET['valor']);
                if(!empty($datos['resennado'])){
                    $valor = $_GET['tipo'].':'.$_GET['valor'];
                    if($datos['resennado'] != 'invalido')
                    {
                        $response = $this->ResennaDTO->okCodeService($servicio, $datos);
                    }else{
                        $datos = $parametros;
                        $response = $this->ResennaDTO->errorInvalidSearch($servicio, $datos);
                    }
                    $this->TrazasDAO->GuardarTraza($_GET['ip'], $_GET['mac'], $_GET['usuario'], $_GET['ente'], $servicio, json_encode($response, true), $valor, $_GET['token']);
                    return $response;
                }else{
                    return $this->ResennaDTO->errorCodeService($servicio);
                }
            }else{
                return $this->ResennaDTO->errorCodeRequest($servicio, $parametros);
            }
        }else if(date('Y-m-d') < Fecha_vencimiento_Token && $_GET['token'] != Token){
            return $this->ResennaDTO->errorCodeToken();
        }else if(date('Y-m-d') > Fecha_vencimiento_Token && $_GET['token'] == Token){
            return $this->ResennaDTO->errorCodeTokenExpire();
        }else if(date('Y-m-d') > Fecha_vencimiento_Token && $_GET['token'] == Token){
            return $this->ResennaDTO->errorNoToken();
        }     
    }

}
?>