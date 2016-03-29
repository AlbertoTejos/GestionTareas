<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicioDAO
 *
 * @author Beto
 */
class servicioDAO extends Model {
    
    function getServicios($id = null, $idArea = null) {
        $sql = "select s.idServicio, s.nombre, s.descripcion, s.area_idArea, a.nombre as nombreArea from servicio s" 
                . " inner join area a on a.idArea = s.area_idArea";
        
        if ($id != null) {
            $sql .= " where s.idServicio = " . $id;
        }
        
       
        
        //Realizamos la consulta
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $sArray = $this->_db->fetchAll($datos);
            $seArray = array();
            
            foreach ($sArray as $s) {
                $servicioDTO = new servicioDTO();
                $servicioDTO->setIdServicio(trim($s['idServicio']));
                $servicioDTO->setNombreServicio(trim($s['nombre']));
                $servicioDTO->setDescripcionServicio(trim($s['descripcion']));
                $servicioDTO->setIdArea(trim($s['area_idArea']));
                $servicioDTO->setNombreArea(trim($s['nombreArea']));
                $seArray[] = $servicioDTO;
            }

            return $seArray;
        } else {
            return false;
        }
    }
    
    public function pagServicios($inicio, $fin, $orden) {    

        $sql = "select s.idServicio, s.nombre, s.descripcion, s.area_idArea, a.nombre as nombreArea from servicio s" 
                . " inner join area a on a.idArea = s.area_idArea"
                . " order by s.idServicio " . $orden 
                . " limit " . $inicio . ", " . $fin;      

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

            $sArray = $this->_db->fetchAll($datos);
            $seArray = array();
            
            foreach ($sArray as $s) {
                $servicioDTO = new servicioDTO();
                $servicioDTO->setIdServicio(trim($s['idServicio']));
                $servicioDTO->setNombreServicio(trim($s['nombre']));
                $servicioDTO->setDescripcionServicio(trim($s['descripcion']));
                $servicioDTO->setIdArea(trim($s['area_idArea']));
                $servicioDTO->setNombreArea(trim($s['nombreArea']));
                $seArray[] = $servicioDTO;
            }

            return $seArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }
    
    function eliminar($idServicio) {
        
        $sql = "delete from servicio where idServicio = " . $idServicio;
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }
        
    }
    
    function modificar($idServicio, $nombre, $descripcion) {
        
        $sql = "update servicio set nombre = '" . $nombre . "', descripcion = '" . $descripcion . "' where idServicio = " . $idServicio;     
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }   
    }
    
    function insertar($nombre, $descripcion, $area) {
        
        $sql = "insert into servicio (nombre, descripcion, area_idArea) 
                values ('$nombre', '$descripcion', '$area')";
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }  
    }
}
