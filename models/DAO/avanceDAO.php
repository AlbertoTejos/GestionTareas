<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of avanceDAO
 *
 * @author Beto
 */
class avanceDAO extends Model {

    //Usuario Cliente
    public function getAvances($id_usuario, $idTarea,  $esSolicitud = false) {

        $sql = "select distinct
                t.idTarea,
                t.nombre,
                t.descripcion,
                t.fechaInicio,
                t.fechaTermino,
                t.horasEstimadas,
                t.fechaReporte,
                t.fechaFinalizacion,
                e.Nombre as estado,
                n.nombre as nivel,
                h.nombre as hito,
                h.estado as estado_hito,
                ev.nombre as evento,
                p.nombre as nombrep,
                tu.horasDia

                from tarea t

                left join tarea_usuario tu
                on tu.Tarea_idTarea = t.idTarea

                inner join estado e
                on e.idEstado = t.Estado_idEstado

                inner join nivel n
                on n.idNivel = t.Nivel_idNivel

                inner join hito h
                on h.idHito = t.Hito_idHito
                
                inner join producto p
                on p.idProducto = h.Producto_idProducto

                inner join evento ev
                on ev.idEvento = t.Evento_idEvento 
                
                where t.id_usuario_crea_tarea = " . $id_usuario;
                
                /* Traemos solo las tareas */
                if (!$esSolicitud ) {
                    $sql .= " and e.idEstado <> 1";
                }else{
                    /* Traemos solo las solicitudes */
                    $sql .= " and e.idEstado = 1";
                }
                
                if($idTarea  != 0){
                    $sql .= " and t.idTarea = ".$idTarea;
                }
                
                //$sql .= " order by h.nombre, t.nombre, e.nombre desc, n.nombre desc";
                $sql .= " order by ev.idEvento, case when n.nombre LIKE '%Urgente%' then 1 when n.nombre LIKE '%Alta%' then 2 else 3 end";
                //echo $sql;
        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

                $avanceArray = $this->_db->fetchAll($datos);
                $aArray = array();

                foreach ($avanceArray as $filas) {

                    $avanceDTO = new avanceDTO();
                    $avanceDTO->setId_tarea($filas['idTarea']);
                    $avanceDTO->setNombre_tarea($filas['nombre']);
                    $avanceDTO->setNombre_modulo($filas['hito']);
                    $avanceDTO->setDesc_tarea($filas['descripcion']);
//                    $avanceDTO->setDesarrollador($filas["Nombres"] . ' ' . $filas["Apellidos"]);
                    $avanceDTO->setEstado($filas['estado']);
                    $avanceDTO->setFecha_fin($filas['fechaTermino']);
                    $avanceDTO->setFecha_inicio($filas['fechaInicio']);
                    $avanceDTO->setHoras_dia($filas['horasDia']);
                    $avanceDTO->setHoras_estimadas($filas['horasEstimadas']);
                    $avanceDTO->setNivel($filas['nivel']);
                    $avanceDTO->setNombre_proyecto($filas['nombrep']);
                    $avanceDTO->setNombre_evento($filas['evento']);
                    $avanceDTO->setFecha_reporte($filas['fechaReporte']);

                    $aArray[] = $avanceDTO;
                }

                return $aArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        }
    }

}
