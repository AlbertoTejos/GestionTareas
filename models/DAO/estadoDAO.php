<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class estadoDAO extends Model{
     public function __construct() {
        parent::__construct();
    }
    
   public function getEstado(){
        $sql = "SELECT idEstado,Nombre, nivelAvance FROM estado";
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $ArrayDB = $this->_db->fetchAll($datos);
            $arr = array();

            foreach ($ArrayDB as $arrdb) {
                 $estObj = new estadoDTO();
                 $estObj->setIdEstado(trim($arrdb['idEstado']));
                 $estObj->setNombre(trim($arrdb['Nombre']));
                 $estObj->setNivelAvance(trim($arrdb['nivelAvance']));
                 
               
            $arr[] = $estObj;                
            }

            return $arr;
        } else {
            return false;
        }
        
        
    
    }
}
