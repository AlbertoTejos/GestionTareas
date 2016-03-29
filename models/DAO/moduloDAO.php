<?php

class moduloDAO extends Model {

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

    public function getModuloSist($id) {
        $sql = "SELECT a.nombre, a.idHito, a.Producto_idProducto, b.nombre AS nombreproducto, a.estado
                FROM hito a
                INNER JOIN producto b ON a.Producto_idProducto = b.idProducto
                WHERE estado =  'V' and a.Producto_idProducto = " . $id . "";
        
        

        //echo $sql;

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new moduloDTO();
                $modObj->setIdHito(trim($moddb['idHito']));
                $modObj->setNombre(trim($moddb['nombre']));
                $modObj->setEstado(trim($moddb['estado']));
                $modObj->setIdProducto(trim($moddb['Producto_idProducto']));

                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
    }

    public function pagModulos($inicio, $fin, $orden) {

        $sql = "select t.idTrabajo, t.tipificacion, t.Producto_idProducto, p.nombre from trabajo t inner join producto p on p.idProducto = t.Producto_idProducto "
                . "order by t.idTrabajo " . $orden
                . " limit " . $inicio . ", " . $fin;
        
//        echo $sql;
        
        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

                $moduloArray = $this->_db->fetchAll($datos);
                $cArray = array();

                foreach ($moduloArray as $filas) {
                    $hitoDTO = new moduloDTO();
                    $hitoDTO->setIdHito($filas['idTrabajo']);
                    $hitoDTO->setNombre($filas['tipificacion']);
//                    $hitoDTO->setEstado($filas['estado']);
                    $hitoDTO->setIdProducto($filas['Producto_idProducto']);
                    $hitoDTO->setNombreProducto($filas['nombre']);
                    $cArray[] = $hitoDTO;
                }

                return $cArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }

    public function getModulo($id, $idUsuario) {
        $sql = "select p.idProducto, t.idTrabajo, t.tipificacion FROM trabajo t inner join producto p on p.idProducto = t.producto_idProducto where t.producto_idproducto = " . $id;

//        echo $sql;
        
        if (!empty($idUsuario)) {
            $sql .= " and tu.usuario_idUsuario = " . $idUsuario;
        }

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new moduloDTO();
                $modObj->setIdHito(trim($moddb['idTrabajo']));
                $modObj->setNombre(trim($moddb['tipificacion']));
//                $modObj->setEstado(trim($moddb['estado']));
                $modObj->setIdProducto(trim($moddb['idProducto']));

                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
    }

    public function getModuloAdm($id, $idProducto) {
        $sql = "select t.tipificacion, t.idTrabajo, t.Producto_idProducto, p.nombre FROM trabajo t"
                . " inner join producto p"
                . " on t.producto_idProducto = p.idProducto";
        if ($id != 0) {

            $sql .= " where t.idTrabajo = " . $id . "";
        }
        
        if ($idProducto != 0) {

            $sql .= " where t.producto_idProducto = " . $idProducto . "";
        }
        
        //echo $sql;
        
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new moduloDTO();
                $modObj->setIdHito(trim($moddb['idTrabajo']));
                $modObj->setNombre(trim($moddb['tipificacion']));
                $modObj->setIdProducto(trim($moddb['Producto_idProducto']));
                $modObj->setNombreProducto(trim($moddb['nombre']));
//                $modObj->setEstado(trim($moddb['estado']));
                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
    }

    public function getTodosModulos() {
        $sql = "select idTrabajo, tipificacion from trabajo";

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $proyArray = $this->_db->fetchAll($datos);
            $proArray = array();

            foreach ($proyArray as $usdb) {
                $proObj = new moduloDTO();
                $proObj->setNombre(trim($usdb['tipificacion']));
                $proObj->setIdHito(trim($usdb['idTrabajo']));

                $proArray[] = $proObj;
            }

            return $proArray;
        } else {
            return false;
        }
    }

    public function cantidadHitosUsuarios($idHito, $idUsuario) {
        $sql = "SELECT  count(Hito_idHito) as cantidad FROM hito_usuario where Hito_idHito = " . $idHito . " and Usuario_idUsuario = " . $idUsuario . "";

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $modArray = $this->_db->fetchAll($datos);
            $moArray = array();

            foreach ($modArray as $moddb) {
                $modObj = new moduloDTO();
                $modObj->setIdHito(trim($moddb['cantidad']));

                $moArray[] = $modObj;
            }

            return $moArray;
        } else {
            return false;
        }
    }

}
