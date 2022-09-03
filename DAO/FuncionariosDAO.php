<?php

require_once('config/Constantes.php');
require_once('config/Sirepol.php');

class FuncionariosDAO 
{

    public $sirepol;

    public function __construct()
    {
        $this->sirepol = new SirepolDB;
    }

    public function ObtenerFuncionario($tipo_consulta, $valor) 
    {
        if($tipo_consulta == 'cedula')
        {
            $columna = 'persons.cedula';
        }else if($tipo_consulta == 'credencial'){
            $columna = 'funcionarios.credencial';
        }else if($tipo_consulta == 'estatus'){
            $columna = 'estatus_funcionario.valor';
        }else{
            return array('funcionario' => 'invalido');
        }
        $sql = "SELECT funcionarios.credencial, persons.primer_nombre, persons.segundo_nombre, persons.primer_apellido, persons.segundo_apellido, 
        jerarquia.valor as jerarquia, estatus_funcionario.valor as estatus
        FROM public.funcionarios INNER JOIN public.persons ON funcionarios.id_person = persons.id INNER JOIN public.jerarquia ON 
        funcionarios.id_jerarquia = jerarquia.id INNER JOIN public.estatus_funcionario ON funcionarios.id_estatus = estatus_funcionario.id
        WHERE $columna = '$valor'";
        $query = $this->sirepol->query($sql);
        if($query->rowCount() >= 1)
        {
            $funcionario = $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $funcionario = 'Sin Registros';
        }
        return array('funcionario' => $funcionario);
    }

}

?>