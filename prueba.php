<?php

require_once 'config/accessToken.php';

$token = new Token();

$jwt = $token->generarToken(MinDefensa, OrganismoMinDefensa, DependenciaMinDefensa, 15);

//$jwt = $token->decodificarToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjI2NzMyODAsImV4cCI6MTY2MjY3MzM0MCwiZGF0YSI6eyJNaW5pc3RlcmlvQWRzY3JpdG8iOiJNaW5pc3RlcmlvIGRlbCBQb2RlciBQb3B1bGFyIHBhcmEgbGEgRGVmZW5zYSIsIk9yZ2FuaXNtbyI6IkRHQ0lNIiwiRGVwZW5kZW5jaWEiOiJEaXZpc2lcdTAwZjNuIGRlIEludmVzdGlnYWNpXHUwMGYzbiJ9fQ.d_QJwMOqc5D0G17YFCEmOHRKiBkmVcAD8gf1X7DGBb8');
//$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjI2NzMyODAsImV4cCI6MTY2MjY3MzM0MCwiZGF0YSI6eyJNaW5pc3RlcmlvQWRzY3JpdG8iOiJNaW5pc3RlcmlvIGRlbCBQb2RlciBQb3B1bGFyIHBhcmEgbGEgRGVmZW5zYSIsIk9yZ2FuaXNtbyI6IkRHQ0lNIiwiRGVwZW5kZW5jaWEiOiJEaXZpc2lcdTAwZjNuIGRlIEludmVzdGlnYWNpXHUwMGYzbiJ9fQ.d_QJwMOqc5D0G17YFCEmOHRKiBkmVcAD8gf1X7DGBb8';
//print_r(json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1])))));
print_r($jwt);

?>