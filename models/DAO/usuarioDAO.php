<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioDAO
 *
 * @author Jaime
 */
class usuarioDAO extends Model {

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
    
    public function nuevoUsuario($nombreUsuario, $pass, $nombre, $apellido, $correo
            , $tipoUsuario, $tipoDesarrollador){
        
        
        $sql = "insert into usuario (idUsuario, nombreUsuario, pass, Nombres, Apellidos
            , fechaRegistro, tipoUsuario, email, tipoDesarrollador) 
                values ('NULL', '$nombreUsuario', '$pass', '$nombre', '$apellido', CURDATE(), '$tipoUsuario', '$correo', '$tipoDesarrollador')";
        
        try {

            if ($this->_db->consulta($sql)) {
                echo 'OK';
            } else {
                echo 'Hubo un error en el ingreso de datos';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->_db->closeConex();
        }
        
    }

    public function getUsuario($user) {
        
        $sql = "select   idUsuario
                        ,nombreUsuario
                        ,pass
                        ,fechaRegistro
                        ,tipoUsuario
                        ,email
                        ,nombres
                        ,apellidos
                FROM usuario ";
        
        if(!empty($user)){
            $sql .= "WHERE nombreUsuario = '" . $user . "'";
        }
                
               
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $userArray = $this->_db->fetchAll($datos);
            $usArray = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();
                $userObj->setIduser(trim($usdb['idUsuario']));
                $userObj->setUsername(trim($usdb['nombreUsuario']));
                $userObj->setPassword(trim($usdb['pass'])); 
                $userObj->setEmail(trim($usdb['email']));
                $userObj->setFechacreacion(trim($usdb['fechaRegistro']));
                $userObj->setPerfil_idperfil(trim($usdb['tipoUsuario']));
                $userObj->setNombre(trim($usdb['nombres']));
                $userObj->setApellido(trim($usdb['apellidos']));
                
            $usArray[] = $userObj;                
            }

            return $usArray;
        } else {
            return false;
        }
    }
    
    public function getUsuarioTarea($tarea, $usuario) {
        
        $sql = "SELECT	d.idUsuario,
                        d.nombres, 
                        d.apellidos,
                        c.fechaInicio,
                        c.fechaFinalizacion,
                        c.fechaAsignacion
                FROM 	tarea a 
                inner join tarea_usuario c on a.idTarea =  c.Tarea_idTarea
                inner join usuario d on c.Usuario_idUsuario = d.idUsuario
                where 1=1";
                       
        if($usuario != 0){
             $sql .= " and d.idUsuario = $usuario";
        }
               
        $sql .= " and a.idTarea = $tarea ";
        // echo $sql;      
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $userArray = $this->_db->fetchAll($datos);
            $usArray = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();
                $userObj->setIduser(trim($usdb['idUsuario']));
                $userObj->setNombre(trim($usdb['nombres']));
                $userObj->setApellido(trim($usdb['apellidos']));
                $userObj->setFechaAsignacion(trim($usdb['fechaAsignacion']));
                $userObj->setFechaInicio(trim($usdb['fechaInicio']));
                $userObj->setFechafinalizacion(trim($usdb['fechaFinalizacion']));
                
            $usArray[] = $userObj;                
            }

            return $usArray;
        } else {
            return false;
        }
    }
    
     public function getUsuarioTareaRech($tarea) {
        
        $sql = "
                select a.idUsuario,
                        a.Nombres, 
                        a.Apellidos,
                        a.email
                from usuario a inner join tarea b on a.idUsuario = b.id_usuario_crea_tarea where b.idTarea = $tarea";

               
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $userArray = $this->_db->fetchAll($datos);
            $usArray = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();
                $userObj->setIduser(trim($usdb['idUsuario']));
                $userObj->setNombre(trim($usdb['Nombres']));
                $userObj->setApellido(trim($usdb['Apellidos']));
                $userObj->setEmail(trim($usdb['email']));
                
            $usArray[] = $userObj;                
            }

            return $usArray;
        } else {
            return false;
        }
    }
    
    
    
     public function getUsuarioId($user) {
        
        $sql = "SELECT   idUsuario
                        ,nombreUsuario
                        ,pass
                        ,fechaRegistro
                        ,tipoUsuario
                        ,EMAIL
                        ,nombres
                        ,apellidos
                FROM usuario ";
        
        if(!empty($user)){
            $sql .= "WHERE idUsuario = '" . $user . "'";
        }
                
               
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $userArray = $this->_db->fetchAll($datos);
            $usArray = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();
                $userObj->setIduser(trim($usdb['idUsuario']));
                $userObj->setUsername(trim($usdb['nombreUsuario']));
                $userObj->setPassword(trim($usdb['pass'])); 
                $userObj->setEmail(trim($usdb['EMAIL']));
                $userObj->setFechacreacion(trim($usdb['fechaRegistro']));
                $userObj->setPerfil_idperfil(trim($usdb['tipoUsuario']));
                $userObj->setNombre(trim($usdb['nombres']));
                $userObj->setApellido(trim($usdb['apellidos']));
                
            $usArray[] = $userObj;                
            }

            return $usArray;
        } else {
            return false;
        }
    }
    
    public function pagUsuarios($inicio, $fin) {    

        $sql = "select u.idUsuario, u.nombreUsuario, u.pass, u.fechaRegistro, u.tipoUsuario, u.email from usuario u"
                . " limit " . $inicio . ", " . $fin;

        try {

            $datos = $this->_db->consulta($sql);
            if ($datos->num_rows > 0) {

                $usuarioArray = $this->_db->fetchAll($datos);
                $uArray = array();

                foreach ($usuarioArray as $filas) {
                    $usuarioDTO = new usuarioDTO();
                    $usuarioDTO->setIduser($filas['idUsuario']);
                    $usuarioDTO->setUsername($filas['nombreUsuario']);
                    $usuarioDTO->setPassword($filas['pass']);
                    $usuarioDTO->setFechacreacion($filas['fechaRegistro']);
                    $usuarioDTO->setPerfil_idperfil($filas['tipoUsuario']);
                    $usuarioDTO->setEmail($filas['email']);

                    $uArray[] = $usuarioDTO;
                }

                return $uArray;
            }
        } catch (Exception $exc) {

            echo 'Error en la consulta';
        } finally {
            $this->_db->closeConex();
        }
    }
    
    public function getUsuarioInterno() {   
        $sql = "SELECT idUsuario, Nombres, Apellidos FROM usuario where tipoUsuario <> 3";
               
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $userArray = $this->_db->fetchAll($datos);
            $usArray = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();
                $userObj->setIduser(trim($usdb['idUsuario']));
                $userObj->setNombre(trim($usdb['Nombres']));
                $userObj->setApellido(trim($usdb['Apellidos'])); 
              
            $usArray[] = $userObj;                
            }

            return $usArray;
        } else {
            return false;
        }
    }
    
    public function getUsuarioPorTipo($tipo) {   
        $sql = "SELECT idUsuario, Nombres, Apellidos FROM gestion.usuario where tipoUsuario = " . $tipo;
               
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {

            $userArray = $this->_db->fetchAll($datos);
            $usArray = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();
                $userObj->setIduser(trim($usdb['idUsuario']));
                $userObj->setNombre(trim($usdb['Nombres']));
                $userObj->setApellido(trim($usdb['Apellidos'])); 
              
            $usArray[] = $userObj;                
            }

            return $usArray;
        } else {
            return false;
        }
    }
    
    public function modificarUsuario($id, $usuario, $perfil, $correo, $pass) {
        
        $sql = "update usuario set nombreUsuario = " . "'$usuario'" . ", pass = '".$pass."',  tipoUsuario = " . "'$perfil'" . ", email = " . "'$correo'" . " where idUsuario = " 
                . $id;
        
        
        $datos = $this->_db->consulta($sql);
        
        if ($datos) {
            echo 'OK';
        }else{
            echo 'Hubo un error en la actualización de datos';
        }
    }
    
    public function eliminarUsuario($id){
        
        $sql = "delete from usuario where idUsuario = " . $id;
        
        echo $sql;
        
        $datos = $this->_db->consulta($sql);
        
        if ($this->_db->numRows($datos) > 0) {
            echo 'OK';
        }else{
            echo 'Hubo un error en la eliminación de datos';
        }
        
    }
    
//    public function getTiposDeUsuario(){
//        
//        $sql = "select u.tipoUsuario from usuario u";
//        $datos = $this->_db->consulta($sql);
//        
//        if ($datos->num_rows > 0) {
//            
//            echo $sql;
//
//                $usuarioArray = $this->_db->fetchAll($datos);
//                $uArray = array();
//
//                foreach ($usuarioArray as $filas) {
//                    $usuarioDTO = new usuarioDTO();
//                    $usuarioDTO->setId_perfil($filas['tipoUsuario']);
//                    $uArray[] = $usuarioDTO;
//                }
//
//                return $uArray;
//            }
//    }
    

}
