<?php 

require_once('config/Constantes.php');

class FuncionariosDTO
{
    public function okCodeService($servicio, $data)
    {
        $response = [
            'Code' => OK_CODE_SERVICE,
            'Status' => OK_DESCRIPTION_SERVICE,
            'Services' => $servicio,
            'Data' => $data
        ];
        return $response;
    }

    public function errorInvalidSearch($servicio, $data)
    {
        unset($data['token'], $data['Service']);
        $response = [
            'Code' => ERROR_CODE_INVALID_SEARCH,
            'Status' => ERROR_DESCRIPTION_INVALID_SEARCH,
            'Services' => $servicio,
            'Data' => $data
        ];
        return $response; 
    }

    public function errorCodeService($servicio)
    {
        $response = [
            'Code' => ERROR_CODE_SERVICE,
            'Status' => ERROR_DESCRIPTION_SERVICE,
            'Services' => $servicio,
            'Description' => 'El Servicio  que intenta consultar no existe'
        ];
        return $response;
    }

    public function errorCodeRequest($servicio, $data)
    {
        unset($data['token'], $data['Service']);
        $response = [
            'Code' => ERROR_CODE_REQUEST,
            'Status' => ERROR_DESCRIPTION_REQUEST,
            'Services' => $servicio,
            'Request' => $data
        ];
        return $response;
    }

    public function errorCodeToken()
    {
        $response = [
            'Code' => ERROR_CODE_TOKEN,
            'Status' => ERROR_DESCRIPTION_TOKEN,
        ];
        return $response;
    }

    public function errorCodeTokenExpire()
    {
        $response = [
            'Code' => ERROR_CODE_TOKEN_EXPIRE,
            'Status' => ERROR_DESCRIPTION_TOKEN_EXPIRE,
        ];
        return $response;
    }

    public function errorNoToken()
    {
        $response = [
            'Code' => ERROR_NO_TOKEN,
            'Status' => ERROR_DESCRIPTION_NO_TOKEN,
        ];
        return $response;
    }

    public function errorUnauthorizedAction()
    {
        $response = [
            'Code' => ERROR_UNAUTHORIZED_ACTION,
            'Status' => ERROR_DESCRIPTION_UNAUTHORIZED_ACTION,
            'Description' => 'La Accion que pretende realizar no se encuentra permitida en este servicio. El incidente sera reportado.'
        ];
        return $response;
    }

    public function okWelcome()
    {
        $response = [
            'Code' => OK_CODE_SERVICE,
            'Status' => OK_DESCRIPTION_SERVICE,
            'Description' => 'Revisa la Documentacion para utilizar el Servicio.'
        ];
        return $response;
    }
    
}

?>