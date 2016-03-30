<?php

class tareaDAO extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function exeSQL($sql) {
        try {
            $this->_db->consulta($sql);
            return 'OK';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCantidadTareaUsuario($idUsuario, $idTarea) {
        $sql = "select count(Tarea_idTarea) as cantidad from tarea_usuario where Tarea_idTarea = $idUsuario and Usuario_idUsuario = $idTarea";


        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new tareaDTO();
                $modObj->setIdTarea(trim($moddb['cantidad']));
                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
    }

    public function getTareaByHito($id, $orden) {
        
        $sql = "SELECT a.nombre, "
                . "a.Hito_idHito, "
                . "a.idTarea, "
                . "a.Nivel_idNivel, "
                . "b.nombre as nivelnombre, "
                . "e.nombre as nombreestado, "
                . "a.horasEstimadas,"
                . "a.fechaTermino, "
                . "(select count(*) from tarea_usuario tu where tu.Tarea_idTarea = a.idTarea) as recursos "
                . "FROM tarea a "
                . "inner join nivel b "
                . "on a.Nivel_idNivel = b.idNivel "
                . "inner join estado e "
                . "on e.idEstado = a.Estado_idEstado "
                . "inner join evento ev "
                . "on ev.idEvento = a.Evento_idEvento "
                . "where a.Hito_idHito = " . $id . " "
                . "and a.Estado_idEstado <> 5 "
                . "and a.Estado_idEstado <> 4 ";
        
        if ($orden != null && $orden == "fecha"){
            $sql .= " order by a.FechaTermino asc";
        } else if ($orden != null && $orden == "prioridad"){
            $sql .= " order by ev.idEvento, case when b.nombre LIKE '%Urgente%' then 1 when b.nombre LIKE '%Alta%' then 2 else 3 end";
        }
        
        $datos = $this->_db->consulta($sql);
        
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new tareaDTO();
                $modObj->setNombre(trim($moddb['nombre']));
                $modObj->setId_hito(trim($moddb['Hito_idHito']));
                $modObj->setIdTarea(trim($moddb['idTarea']));
                $modObj->setId_nivel(trim($moddb['Nivel_idNivel']));
                $modObj->setNombre_estado(trim($moddb['nombreestado']));
                $modObj->setHorasEstimadas(trim($moddb['horasEstimadas']));
                $modObj->setCantidadDeRecursos(trim($moddb['recursos']));
                $modObj->setFechaTermino(trim($moddb['fechaTermino']));
                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
    }
    
    public function getAvanceUsuario($idTarea, $idUsuario) {
        
        $sql = "select tu.fechaUltimoAvance, tu.horasEfectivas, tu.fechaContinuacion, tu.estadoAvance from tarea_usuario tu"
                . " where tu.Tarea_idTarea = " . $idTarea . " and tu.Usuario_idUsuario = " . $idUsuario;
        
        $datos = $this->_db->consulta($sql);
        
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new tareaDTO();
                $modObj->setFechaUltimoAvance(trim($moddb['fechaUltimoAvance']));
                $modObj->setHorasEfectivas(trim($moddb['horasEfectivas']));
                $modObj->setEstadoAvance(trim($moddb['estadoAvance']));
                $modObj->setFechaContinuacion(trim($moddb['fechaContinuacion']));
                $moArray[] = $modObj;
            }
            return $moArray;
        } else {
            return false;
        }     
    }

    public function getTarea($id, $descripcion = null, $solucion = null) {
        
        $sql = "SELECT "
                . "a.idTarea, "
                . "a.descripcionProblema, "
                . "a.solucionPropuesta, "
                . "e.idEstado, "
                . "a.servicio_idServicio, "
                . "a.fechaReporte, "
                . "a.idUsuarioAsigna "
                . "FROM tarea a "
                . "inner join estado e "
                . "on a.estado_idEstado = e.idEstado "
                . "inner join usuario u "
                . "on u.idUsuario = a.idUsuarioAsigna "
                . "left join tarea_usuario tu "
                . "on tu.Tarea_idTarea = a.idTarea ";
        
        $aux = "where "; 
        
        if ($id != null) {
            $sql .= "where a.idTarea = " . $id . " ";
            $aux = "and ";
        }
        
        if ($descripcion != null) {
            $sql .= $aux . " a.descripcionProblema = '" . $descripcion . "' ";
            $aux = "and ";          
        }
        
        if ($solucion != null) {
            $sql .= $aux . " a.solucionPropuesta = '" . $solucion . "' ";
        }
        
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new tareaDTO();
//                $modObj->setNombre(trim($moddb['nombre']));
//                $modObj->setId_hito(trim($moddb['Hito_idHito']));
                $modObj->setIdTarea(trim($moddb['idTarea']));
//                $modObj->setId_nivel(trim($moddb['Nivel_idNivel']));
//                $modObj->setDescripcion(trim($moddb['nivelnombre']));
                $modObj->setDescripcionTarea(trim($moddb['descripcionProblema']));
                $modObj->setId_estado(trim($moddb['idEstado']));
//                $modObj->setNombre_Estado(trim($moddb['Nombre']));
//                $modObj->setNombre_evento(trim($moddb['nombreevento']));
//                $modObj->setNombre_nivel(trim($moddb['nombrenivel']));
                $modObj->setFechaReporte(trim($moddb['fechaReporte']));
//                $modObj->setHorasEstimadas(trim($moddb['horasEstimadas']));
//                $modObj->setFechaInicio(trim($moddb['fechaInicio']));
//                $modObj->setFechaTermino(trim($moddb['fechaTermino']));
//                $modObj->setNombre_admin_asigna(trim($moddb['nombreadmin']));
                $modObj->setSolucionPropuesta(trim($moddb['solucionPropuesta']));
                $modObj->setId_user(trim($moddb['idUsuarioAsigna']));
//                $modObj->setFechaTerminoActividad(trim($moddb['fechaTerminoActividad']));
//                $modObj->setHorasDias(trim($moddb['horasDia']));
                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
        
        
    }

    public function getTareasUsuario($idUsuario, $hito) {

        $sql = "select
                t.idTarea,
                t.nombre,
                t.descripcion,
                t.formulario,
                t.flujoCorrecto,
                t.fechaReporte,
                t.fechaTermino,
                t.horasEstimadas,
                t.fechaFinalizacion,
                t.solucionPropuesta,
                t.motivoRechazo,
                e.Nombre as estado,
                e.nivelAvance,
                n.nombre as nivel,
                h.nombre as modulo,
                ev.nombre as evento,
                n.idNivel,
                tu.horasDia

                from tarea_usuario tu

                inner join tarea t
                on tu.Tarea_idTarea = t.idTarea

                inner join estado e
                on e.idEstado = t.Estado_idEstado

                inner join nivel n
                on n.idNivel = t.Nivel_idNivel

                inner join hito h
                on h.idHito = t.Hito_idHito

                inner join evento ev
                on ev.idEvento = t.Evento_idEvento

                where e.idEstado <> 0 and e.idEstado <> 1 and e.idEstado <> 4 " .
                "and tu.Usuario_idUsuario = " . $idUsuario . " and h.idHito = " . $hito . "";





        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            //echo $sql;
            $tareaArray = $this->_db->fetchAll($datos);
            $tArray = array();

            foreach ($tareaArray as $filas) {

                $tareaDTO = new tareaDTO();
                $tareaDTO->setId_evento(trim($filas['idTarea']));
                $tareaDTO->setNombre(trim($filas['nombre']));
                $tareaDTO->setId_nivel(trim($filas['idNivel']));
                $tareaDTO->setDescripcionTarea(trim($filas['descripcion']));
                $tareaDTO->setNombreNivel(trim($filas['nivel']));
                $tareaDTO->setNombre_evento(trim($filas['evento']));
                $tareaDTO->setHorasEstimadas(trim($filas['horasEstimadas']));
                $tareaDTO->setHorasDia(trim($filas['horasDia']));
                $tareaDTO->setFechaTermino(trim($filas['fechaTermino']));
                $tArray[] = $tareaDTO;
            }

            return $tArray;
        } else {
            return false;
        }
    }
     public function getUltTarea() {

        $sql = "SELECT MAX( idTarea ) AS id FROM tarea ";

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            //echo $sql;
            $tareaArray = $this->_db->fetchAll($datos);
            $tArray = array();

            foreach ($tareaArray as $filas) {

                $tareaDTO = new tareaDTO();
                $tareaDTO->setIdTarea(trim($filas['id']));
               
                $tArray[] = $tareaDTO;
            }

            return $tArray;
        } else {
            return false;
        }
    }

}
