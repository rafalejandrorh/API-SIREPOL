<?php

require_once('DAO/ResennaDAO.php');
require_once('DAO/TrazasDAO.php');
require_once('DTO/ResennaDTO.php');
require_once('DAO/TokenDAO.php');

class ResennaBLL
{

    public function __construct()
    {
        $this->ResennaDAO = new ResennaDAO();
        $this->ResennaDTO = new ResennaDTO();
        $this->TrazasDAO = new TrazasDAO();
        $this->TokenDAO = new TokenDAO();
    }

    public function Welcome()
    {
        return $this->ResennaDTO->okWelcome();
    }

    public function Unauthorized()
    {
        return $this->ResennaDTO->errorUnauthorizedAction();
    }

    public function ServicioConsultaResennado($parametros) 
    {
        $servicio = $parametros['Service'];
        $valor = $parametros['tipo'].': '.$parametros['valor'];
        $token = $this->TokenDAO->validarToken($parametros['token']);
        
        if(!isset($token[0]['No_Query']))
        {
            if(date('Y-m-d') < $token[0]['expires_at'] && $parametros['token'] == $token[0]['token'] && $token[0]['estatus'] == true)
            {
                if($parametros['tipo'] != null && $parametros['valor'] != null && $parametros['ip'] != null && $parametros['mac'] != null && $parametros['ente'] != null && $parametros['usuario'] != null)
                {
                    $datos = $this->ResennaDAO->ObtenerResennado($parametros['tipo'], $parametros['valor']);
                    if(!empty($datos['resennado'])){
                        if($datos['resennado'] != 'invalido')
                        {
                            $response = $this->ResennaDTO->okCodeService($servicio, $datos);
                        }else{
                            $datos = $parametros;
                            $response = $this->ResennaDTO->errorInvalidSearch($servicio, $datos);
                        }
                    }else{
                        $response = $this->ResennaDTO->errorCodeService($servicio);
                    }
                }else{
                    $response = $this->ResennaDTO->errorCodeRequest($servicio, $parametros);
                }
            }else if(date('Y-m-d') > $token[0]['expires_at'] && $parametros['token'] == $token[0]['token'] && $token[0]['estatus'] == true){
                $response = $this->ResennaDTO->errorCodeTokenExpire();
            }else if(date('Y-m-d') < $token[0]['expires_at'] && $parametros['token'] == null && $token[0]['estatus'] == true){
                $response = $this->ResennaDTO->errorCodeNoToken();
            }else if(date('Y-m-d') < $token[0]['expires_at'] && $parametros['token'] == $token[0]['token'] && $token[0]['estatus'] == false){
                $response = $this->ResennaDTO->errorCodeInactiveToken();
            }
        }else{
            $response = $this->ResennaDTO->errorCodeToken();
        }
        $this->TrazasDAO->GuardarTraza($parametros['ip'], $parametros['mac'], $parametros['usuario'], $parametros['ente'], $servicio, json_encode($response, true), $valor, $parametros['token']);
        return $response;     
    }

}

?>