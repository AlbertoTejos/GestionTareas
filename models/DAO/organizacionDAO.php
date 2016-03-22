<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of organizacionDAO
 *
 * @author Jaime
 */
class organizacionDAO extends Model {
    
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
    
      public function getOrganizacionUsuario() {

        $sql = "SELECT   IDORGANIZACION
                        ,DESCRIPCION
                        ,FECHA
                        ,USUARIO_IDUSER    
                FROM ORGANIZACION
                WHERE USUARIO_IDUSER = '" . Session::get('SESS_ID_USER') . "'";
               
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $orgArray = $this->_db->fetchAll($datos);
            $orArray = array();

            foreach ($orgArray as $usdb) {
                $orgObj = new organizacionDTO();
                $orgObj->setId_organizacion(trim($usdb['IDORGANIZACION']));
                $orgObj->setDescripcion(trim($usdb['DESCRIPCION']));
                $orgObj->setFechacreacion(trim($usdb['FECHA']));
                $orgObj->setUsuario(trim($usdb['USUARIO_IDUSER']));   
            $orArray[] = $orgObj;                
            }

            return $orArray;
        } else {
            return false;
        }
    }
    
}
