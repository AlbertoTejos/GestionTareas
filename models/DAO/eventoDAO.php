<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eventoDAO
 *
 * @author Beto
 */
class eventoDAO extends Model{
    
    /*
     * Método encargada de traer todos los eventos para su administración
     */
    function getEventos($idEvento, $idTrabajo) {
        $sql = "select e.idEvento, e.nombre, e.Trabajo_idTrabajo, t.tipificacion, p.nombre as 'proyecto' from evento e" 
                . " inner join Trabajo t on t.idTrabajo = e.Trabajo_idTrabajo"
                . " inner join producto p on p.idProducto = t.producto_idProducto ";
        
        if ($idEvento != null) {
            $sql .= " where e.idEvento = " . $idEvento;
        }
        
        if ($idTrabajo != null) {
            $sql .= " where t.idTrabajo = " . $idTrabajo;
        }
        
       
        
        //Realizamos la consulta
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $eArray = $this->_db->fetchAll($datos);
            $evArray = array();
            
            foreach ($eArray as $e) {
                $eventoDTO = new eventoDTO();
                $eventoDTO->setIdEvento(trim($e['idEvento']));
                $eventoDTO->setNombreEvento(trim($e['nombre']));
                $eventoDTO->setIdTrabajo(trim($e['Trabajo_idTrabajo']));
                $eventoDTO->setNombreTrabajo(trim($e['tipificacion']));
                $eventoDTO->setNombreProyecto(trim($e['proyecto']));
                $evArray[] = $eventoDTO;
            }

            return $evArray;
        } else {
            return false;
        }
    }
    
    public function pagEventos($inicio, $fin, $orden) {    

        $sql = "select e.idEvento, e.nombre, e.Trabajo_idTrabajo, t.tipificacion, p.nombre as 'proyecto' from evento e inner join trabajo t"
                . " on t.idTrabajo = e.Trabajo_idTrabajo"
                . " inner join producto p on p.idProducto = t.producto_idProducto"
                . " order by e.idEvento " . $orden 
                . " limit " . $inicio . ", " . $fin;      

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

                $eArray = $this->_db->fetchAll($datos);
                $evArray = array();

                foreach ($eArray as $filas) {
                    $eventoDTO = new eventoDTO();
                    $eventoDTO->setIdEvento($filas['idEvento']);
                    $eventoDTO->setNombreEvento($filas['nombre']);
                    $eventoDTO->setIdTrabajo($filas['Trabajo_idTrabajo']);
                    $eventoDTO->setNombreTrabajo(trim($filas['tipificacion']));
                    $eventoDTO->setNombreProyecto(trim($filas['proyecto']));
                    
                    $evArray[] = $eventoDTO;
                }

                return $evArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }
    
    function eliminar($idEvento) {
        
        $sql = "delete from evento where idEvento = " . $idEvento;
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }
        
    }
    
    function modificar($idEvento, $nombreEvento) {
        
        $sql = "update evento set nombre = '" . $nombreEvento . "' where idEvento = " . $idEvento;     
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }   
    }
    
    function insertar($trabajo, $evento) {
        
        $sql = "insert into evento (nombre, trabajo_idTrabajo) 
                values ('$evento', '$trabajo')";
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }  
    }
    
}
