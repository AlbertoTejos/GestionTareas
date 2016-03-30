<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of archivoDAO
 *
 * @author Beto
 */
class archivoDAO extends Model{
    
    public function ingresar($idSolicitud, $path) {
        
        $path_ = addslashes($path);
        
        $sql = "insert into archivo (idSolicitud, path) values ('$idSolicitud', '$path_')";
        
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
