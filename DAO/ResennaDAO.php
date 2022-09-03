<?php

require_once('config/Constantes.php');
require_once('config/Sirepol.php');

class ResennaDAO 
{

    public $sirepol;

    public function __construct()
    {
        $this->sirepol = new SirepolDB;
    }

    public function ObtenerResennado($tipo_consulta, $valor) 
    {
        if($tipo_consulta == 'cedula')
        {
            $columna = 'detenido.cedula';
        }else{
            return array('resennado' => 'invalido');
        }
        $sql = "SELECT detenido.cedula, detenido.primer_nombre, detenido.segundo_nombre, detenido.primer_apellido, detenido.segundo_apellido,
        caracteristicas_resennado.valor AS motivo_resenna, 
        (Funcionario_aprehensor.primer_nombre || ' ' || Funcionario_aprehensor.primer_apellido) AS funcionario_aprehensor,
        (Funcionario_resenna.primer_nombre || ' ' || Funcionario_resenna.primer_apellido) AS funcionario_resenna
        FROM public.persons as detenido
		INNER JOIN public.resenna_detenido ON detenido.id = resenna_detenido.id_person 
		INNER JOIN public.caracteristicas_resennado ON caracteristicas_resennado.id = resenna_detenido.id_motivo_resenna 
        INNER JOIN public.funcionarios AS id_funcionario_aprehensor ON id_funcionario_aprehensor.id = resenna_detenido.id_funcionario_aprehensor
        INNER JOIN public.persons AS Funcionario_aprehensor ON id_funcionario_aprehensor.id_person = Funcionario_aprehensor.id
        INNER JOIN public.funcionarios AS id_funcionario_resenna ON id_funcionario_resenna.id = resenna_detenido.id_funcionario_resenna
        INNER JOIN public.persons AS Funcionario_resenna ON id_funcionario_resenna.id_person = Funcionario_resenna.id
        WHERE $columna = '$valor'";
        $query = $this->sirepol->query($sql);
        if($query->rowCount() >= 1)
        {
            $resennado = $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $resennado = 'Sin Registros';
        }
        return array('resennado' => $resennado);
    }

}

?>