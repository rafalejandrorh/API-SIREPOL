<?php

require_once('DAO/FuncionariosDAO.php');
require_once('DAO/TrazasDAO.php');
require_once('DTO/FuncionariosDTO.php');
require_once('DAO/TokenDAO.php');

class FuncionariosBLL
{

    public function __construct()
    {
        $this->FuncionariosDAO = new FuncionariosDAO();
        $this->FuncionariosDTO = new FuncionariosDTO();
        $this->TrazasDAO = new TrazasDAO();
        $this->TokenDAO = new TokenDAO();
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
        $token = $this->TokenDAO->validarToken($parametros['token']);
        
        if(!isset($token[0]['No_Query']))
        {
            if(date('Y-m-d') < $token[0]['expires_at'] && $parametros['token'] == $token[0]['token'])
            {
                if($parametros['tipo'] != null && $parametros['valor'] != null && $parametros['ip'] != null && $parametros['mac'] != null && $parametros['ente'] != null && $parametros['usuario'] != null)
                {
                    $datos = $this->FuncionariosDAO->ObtenerFuncionario($parametros['tipo'], $parametros['valor']);
                    if(!empty($datos['funcionario'])){
                        $valor = $parametros['tipo'].': '.$parametros['valor'];
                        if($datos['funcionario'] != 'invalido')
                        {
                            $response = $this->FuncionariosDTO->okCodeService($servicio, $datos);
                        }else{
                            $datos = $parametros;
                            $response = $this->FuncionariosDTO->errorInvalidSearch($servicio, $datos);
                        }
                        $this->TrazasDAO->GuardarTraza($parametros['ip'], $parametros['mac'], $parametros['usuario'], $parametros['ente'], $servicio, json_encode($response, true), $valor, $parametros['token']);
                        $response;
                    }else{
                        $response = $this->FuncionariosDTO->errorCodeService($servicio);
                    }
                }else{
                    $response = $this->FuncionariosDTO->errorCodeRequest($servicio, $parametros);
                }
            }else if(date('Y-m-d') > $token[0]['expires_at'] && $parametros['token'] == $token[0]['token']){
                $response = $this->FuncionariosDTO->errorCodeTokenExpire();
            }else if(date('Y-m-d') > $token[0]['expires_at'] && $parametros['token'] == $token[0]['token']){
                $response = $this->FuncionariosDTO->errorNoToken();
            }
        }else{
            $response = $this->FuncionariosDTO->errorCodeToken();
        }
        $this->TrazasDAO->GuardarTraza($parametros['ip'], $parametros['mac'], $parametros['usuario'], $parametros['ente'], $servicio, json_encode($response, true), $valor, $parametros['token']);
        return $response; 
    }

}
?>