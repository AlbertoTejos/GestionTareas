<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nivelDAO
 *
 * @author Beto
 */
class nivelDAO extends Model {
    
    function getNiveles($id = null, $idProyecto = null) {
        $sql = "select n.idNivel, n.nombre, n.tiempoMaximo, n.producto_idProducto, p.nombre as nombreProducto from nivel n"
                . " inner join producto p on p.idProducto = n.producto_idProducto";
        
        if ($id != null) {
            $sql .= " where n.idNivel = " . $id;
        }
        
        if ($idProyecto != null) {
            $sql .= " where p.idProducto = " . $idProyecto;
        }
        
        //Realizamos la consulta
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $nArray = $this->_db->fetchAll($datos);
            $niArray = array();
            
            foreach ($nArray as $n) {
                $nivelDTO = new nivelDTO();
                $nivelDTO->setIdNivel(trim($n['idNivel']));
                $nivelDTO->setNombreNivel(trim($n['nombre']));
                $nivelDTO->setTiempoMaximo(trim($n['tiempoMaximo']));
                $nivelDTO->setIdProyecto(trim($n['producto_idProducto']));
                $nivelDTO->setNombreProyecto(trim($n['nombreProducto']));
                $niArray[] = $nivelDTO;
            }

            return $niArray;
        } else {
            return false;
        }
    }
    
    public function pagAreas($inicio, $fin, $orden) {    

        $sql = "select n.idNivel, n.nombre, n.tiempoMaximo, n.producto_idProducto, p.nombre as nombreProducto from nivel n"
                . " inner join producto p on p.idProducto = n.producto_idProducto"
                . " order by n.idNivel " . $orden 
                . " limit " . $inicio . ", " . $fin;      

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

            $nArray = $this->_db->fetchAll($datos);
            $niArray = array();
            
            foreach ($nArray as $n) {
                $nivelDTO = new nivelDTO();
                $nivelDTO->setIdNivel(trim($n['idNivel']));
                $nivelDTO->setNombreNivel(trim($n['nombre']));
                $nivelDTO->setTiempoMaximo(trim($n['tiempoMaximo']));
                $nivelDTO->setIdProyecto(trim($n['producto_idProducto']));
                $nivelDTO->setNombreProyecto(trim($n['nombreProducto']));
                $niArray[] = $nivelDTO;
            }

            return $niArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }
    
    function eliminar($idNivel) {
        
        $sql = "delete from nivel where idNivel = " . $idNivel;
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }
        
    }
    
    function modificar($idNivel, $nombreNivel, $tiempoMaximo) {
        
        $sql = "update nivel set nombre = '" . $nombreNivel . "', tiempoMaximo = '" . $tiempoMaximo . "' where idNivel = " . $idNivel;     
        
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }   
    }
    
    function insertar($nombre, $tiempoMaximo, $idProyecto) {
        
        $sql = "insert into nivel (nombre, tiempoMaximo, producto_idProducto) 
                values ('$nombre', '$tiempoMaximo', '$idProyecto')";
        
        if ($this->_db->consulta($sql)) {
            echo "OK";
        }else{
            echo "Error en la consulta";
        }  
    }
}
