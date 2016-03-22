<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clienteDAO
 *
 * @author Beto
 */
class clienteDAO extends Model {

    function __construct() {
        parent:: __construct();
    }

    public function getCliente($id) {

        $query = "select c.idCliente, c.nombre, c.nombreCorto from cliente c";

        if ($id > 0) {

            $query .= " where c.idCliente = " . $id;
        }

        try {

            $datos = $this->_db->consulta($query);
            if ($datos->num_rows > 0) {

                $clienteArray = $this->_db->fetchAll($datos);
                $cArray = array();

                foreach ($clienteArray as $filas) {
                    $clienteDTO = new clienteDTO();
                    $clienteDTO->setId($filas['idCliente']);
                    $clienteDTO->setNombre($filas['nombre']);
                    $clienteDTO->setNombreCorto($filas['nombreCorto']);

                    $cArray[] = $clienteDTO;
                }

                return $cArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        }
    }

    public function pagClientes($inicio, $fin, $orden) {    

        $sql = "select c.idCliente, c.nombre, c.nombreCorto from cliente c "
                . "order by c.idCliente " . $orden 
                . " limit " . $inicio . ", " . $fin;

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

                $clienteArray = $this->_db->fetchAll($datos);
                $cArray = array();

                foreach ($clienteArray as $filas) {
                    $clienteDTO = new clienteDTO();
                    $clienteDTO->setId($filas['idCliente']);
                    $clienteDTO->setNombre($filas['nombre']);
                    $clienteDTO->setNombreCorto($filas['nombreCorto']);

                    $cArray[] = $clienteDTO;
                }

                return $cArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }

    public function insertarCliente($nombre, $nombreCorto) {

        $sql = "insert into cliente (nombre, nombreCorto) 
                values ('$nombre', '$nombreCorto')";


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

    public function eliminarCliente($id) {

        $sql = "delete from cliente where idCliente = " . $id;

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

    public function modificarCliente($id, $nombre, $nombreCorto) {

        $sql = "update cliente c set c.nombre = '" . $nombre . "', c.nombreCorto = '" . $nombreCorto . "' where c.idCliente = " . $id;

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
