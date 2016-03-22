<?php

class proyectoDAO extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getProyectoUsuario($producto, $usuairo) {
            $sql = "select count(producto_idProducto) as cantidad from producto_usuario where producto_idProducto = ".$producto." and usuario_idUsuario = ".$usuairo."" ;

            $datos = $this->_db->consulta($sql);
            if ($this->_db->numRows($datos) > 0) {

                $proyArray = $this->_db->fetchAll($datos);
                $proArray = array();

                foreach ($proyArray as $usdb) {
                    $proObj = new proyectoDTO();
                    
                    $proObj->setId_producto(trim($usdb['cantidad']));

                    $proArray[] = $proObj;
                }

                return $proArray;
            } else {
                return false;
            }
        }
    public function getTodosProyectos() {
            $sql = "select idProducto, nombre from producto" ;

            $datos = $this->_db->consulta($sql);
            if ($this->_db->numRows($datos) > 0) {

                $proyArray = $this->_db->fetchAll($datos);
                $proArray = array();

                foreach ($proyArray as $usdb) {
                    $proObj = new proyectoDTO();
                    $proObj->setNombre(trim($usdb['nombre']));
                    $proObj->setId_producto(trim($usdb['idProducto']));

                    $proArray[] = $proObj;
                }

                return $proArray;
            } else {
                return false;
            }
        }
    public function getProductosUsuarios() {
        $sql = "select p.idProducto, p.nombre, pu.usuario_idUsuario from producto p
                inner join producto_usuario pu on p.idProducto = pu.producto_idProducto
                where pu.usuario_idUsuario = " . Session::get("SESS_ID_USER") . "";
//        echo $sql;
        

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $proyArray = $this->_db->fetchAll($datos);
            $proArray = array();

            foreach ($proyArray as $usdb) {
                $proObj = new proyectoDTO();
                $proObj->setNombre(trim($usdb['nombre']));
                $proObj->setId_producto(trim($usdb['idProducto']));

                $proArray[] = $proObj;
            }

            return $proArray;
        } else {
            return false;
        }
    }

    public function getProyectos($id, $idCliente) {

        $sql = "select 
                p.idProducto as ID, 
                
                p.nombre as Nombre, 
                p.nemo as Nemo,
                c.nombre as Cliente

                from producto p

                inner join cliente c
                on c.idCliente = p.Cliente_idCliente";

        if (!empty($id)) {
            $sql .= " where p.idProducto = " . $id;
        }
        
        if (!empty($idCliente)) {
            $sql .= " where c.idCliente = " . $idCliente;
        }

        $datos = $this->_db->consulta($sql);

        if ($datos->num_rows > 0) {

            try {
                $resultados = $this->_db->fetchAll($datos);
                $array = array();

                foreach ($resultados as $fila) {

                    $proyectoDTO = new proyectoDTO();
                    $proyectoDTO->setId_producto($fila['ID']);
                    $proyectoDTO->setNombre($fila['Nombre']);
                    $proyectoDTO->setNemo($fila['Nemo']);
                    $proyectoDTO->setCliente($fila['Cliente']);
                    $array[] = $proyectoDTO;
                }

                return $array;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }
    
    public function pagProyectos($inicio, $fin) {    

        $sql = "select 
                p.idProducto as ID, 
                
                p.nombre as Nombre, 
                p.nemo as Nemo,
                c.nombre as Cliente

                from producto p

                inner join cliente c
                on c.idcliente = p.Cliente_idCliente limit " . $inicio . ", " . $fin;

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

                $proyectoArray = $this->_db->fetchAll($datos);
                $pArray = array();

                foreach ($proyectoArray as $filas) {
                    $proyectoDTO = new proyectoDTO();
                    $proyectoDTO->setId_producto($filas['ID']);
                    $proyectoDTO->setNombre($filas['Nombre']);
                    $proyectoDTO->setNemo($filas['Nemo']);
                    $proyectoDTO->setCliente($filas['Cliente']);

                    $pArray[] = $proyectoDTO;
                }

                return $pArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }

    public function getHitos($idProducto) {

        $sql = "select h.idHito, h.nombre, h.estado from hito h where Producto_idProducto = " . $idProducto;

        try {

            $datos = $this->_db->consulta($sql);

            if ($datos->num_rows > 0) {


                $resultados = $this->_db->fetchAll($datos);
                $array = array();

                foreach ($resultados as $fila) {

                    $moduloDTO = new moduloDTO();
                    $moduloDTO->setId($fila['idHito']);
                    $moduloDTO->setNombre($fila['nombre']);
                    $moduloDTO->setEstado($fila['estado']);
                    $array[] = $moduloDTO;
                }

                return $array;
                
            } else {
                echo 'Error en la consulta';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->_db->closeConex();
        }
    }

    public function insertarProyecto($nombre, $nemo, $idCliente) {

        $sql = "insert into producto (idProducto, nombre, nemo, Cliente_idCliente)"
                . "values ('NULL', '$nombre', '$nemo', '$idCliente')";


        try {

            if ($this->_db->consulta($sql)) {
                return true;
            } else {
                echo 'Error en la consulta';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->_db->closeConex();
        }
    }

    public function eliminarProyecto($id) {

        $sql = "delete from producto where idProducto = " . $id;

        try {

            if ($this->_db->consulta($sql)) {
                return true;
            } else {
                echo 'Error en la consulta';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->_db->closeConex();
        }
    }

    public function modificarProyecto($id, $nombre, $nemo) {

        $sql = "update producto p set p.nombre = '" . $nombre . "', p.nemo = '" . $nemo . "' where p.idProducto = " . $id;

        try {

            if ($this->_db->consulta($sql)) {
                return true;
            } else {
                echo 'Error en la consulta';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->_db->closeConex();
        }
    }

}
