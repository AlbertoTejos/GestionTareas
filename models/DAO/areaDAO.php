<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of areaDAO
 *
 * @author Alberto Tejos
 */
class areaDAO extends Model {
    
    function getAreas($id = null, $idEvento = null) {
        $sql = "select a.idArea, a.nombre, a.evento_idEvento, e.nombre as nombreEvento from area a" 
                . " inner join evento e on e.idEvento = a.evento_idEvento";
        
        if ($id != null) {
            $sql .= " where a.idArea = " . $id;
        }
        
        if ($idEvento != null) {
            $sql .= " where e.idEvento = " . $idEvento;
        }
        
        //echo $sql;
        
        //Realizamos la consulta
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $aArray = $this->_db->fetchAll($datos);
            $arArray = array();
            
            foreach ($aArray as $a) {
                $areaDTO = new areaDTO();
                $areaDTO->setIdArea(trim($a['idArea']));
                $areaDTO->setNombre(trim($a['nombre']));
                $areaDTO->setIdEvento(trim($a['evento_idEvento']));
                $areaDTO->setNombreEvento(trim($a['nombreEvento']));
                $arArray[] = $areaDTO;
            }

            return $arArray;
        } else {
            return false;
        }
    }
    
    public function pagAreas($inicio, $fin, $orden) {    

        $sql = "select a.idArea, a.nombre, a.evento_idEvento, e.nombre as nombreEvento from area a"
                . " inner join evento e on e.idEvento = a.evento_idEvento"
                . " order by a.idArea " . $orden 
                . " limit " . $inicio . ", " . $fin;      

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

            $aArray = $this->_db->fetchAll($datos);
            $arArray = array();
            
            foreach ($aArray as $a) {
                $areaDTO = new areaDTO();
                $areaDTO->setIdArea(trim($a['idArea']));
                $areaDTO->setNombre(trim($a['nombre']));
                $areaDTO->setIdEvento(trim($a['evento_idEvento']));
                $areaDTO->setNombreEvento(trim($a['nombreEvento']));
                $arArray[] = $areaDTO;
            }

                return $arArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }
    
    function eliminar($idArea) {
        
        $sql = "delete from area where idArea = " . $idArea;
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }
        
    }
    
    function modificar($idArea, $nombreArea) {
        
        $sql = "update area set nombre = '" . $nombreArea . "' where idArea = " . $idArea;     
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }   
    }
    
    function insertar($evento, $area) {
        
        $sql = "insert into area (nombre, evento_idEvento) 
                values ('$area', '$evento')";
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }  
    }
}
