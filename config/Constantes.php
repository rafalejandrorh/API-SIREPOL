<?php

//Nombre Otorgado a la API según la institución que lo consumirá
define('Titulo', 'API SIREPOL');

//Timezone (Hora Local)
define('Ubicacion', 'America/Caracas');

//Conexión a la Base de Datos de SIREPOL
define('DB_HOST_SIREPOL', 'localhost');
define('DB_USER_SIREPOL', 'postgres');
define('DB_PASSWORD_SIREPOL', 'Caracasfc*2021');
define('DB_NAMEDB_SIREPOL', 'SIREPOL');
define('DB_TYPE_SIREPOL', 'pgsql');
define('DB_PORT_SIREPOL', '5432');

//Conexión a la Base de Datos de Auditoría
define('DB_HOST_TRAZAS', 'localhost');
define('DB_USER_TRAZAS', 'postgres');
define('DB_PASSWORD_TRAZAS', 'Caracasfc*2021');
define('DB_NAMEDB_TRAZAS', 'Auditoria_WS');
define('DB_TYPE_TRAZAS', 'pgsql');
define('DB_PORT_TRAZAS', '5432');

// Servicios Disponibles para consultar
define('ConsultaFuncionario', 'ConsultaFuncionario');
define('ConsultaResennado', 'ConsultaResennado');

/////// Responses de API ///////

// Ok (Se realiza la consulta)
define('OK_CODE_SERVICE', 200);
define('OK_DESCRIPTION_SERVICE', 'Service Ok'); 

// Nok (Error en el servicio consultado)
define('ERROR_CODE_SERVICE', 404);
define('ERROR_DESCRIPTION_SERVICE', 'Service Nok');

// Nok (Error en la Solicitud al servicio)
define('ERROR_CODE_REQUEST', 405);
define('ERROR_DESCRIPTION_REQUEST', 'Request Nok');

// Nok (Error por Token Expirado)
define('ERROR_CODE_TOKEN_EXPIRE', 406);
define('ERROR_DESCRIPTION_TOKEN_EXPIRE', 'Token Expire');

// Nok (Error por Token Incorrecto)
define('ERROR_CODE_TOKEN', 407);
define('ERROR_DESCRIPTION_TOKEN', 'Token Nok');

// Nok (Error por no Colocar Token)
define('ERROR_NO_TOKEN', 408);
define('ERROR_DESCRIPTION_NO_TOKEN', 'No Token');

// Nok (Búsqueda Inválida)
define('ERROR_CODE_INVALID_SEARCH', 409);
define('ERROR_DESCRIPTION_INVALID_SEARCH', 'Invalid Search');

// Nok (Acción no permitida en el servicio)
define('ERROR_UNAUTHORIZED_ACTION', 500);
define('ERROR_DESCRIPTION_UNAUTHORIZED_ACTION', 'Unauthorized');

/////// Token ///////

define('Token', 'PLIbWwxXce3VpvBT_O977da8XECEpJTJt');
define('Fecha_vencimiento_Token', '2022-10-09');

?>