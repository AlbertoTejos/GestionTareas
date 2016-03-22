<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioDTO
 *
 * @author Jaime
 */
class usuarioDTO {
 private $iduser;
 private $perfil_idperfil;
 private $username;
 private $password;
 private $nombre;
 private $apellido;
 private $email;
 private $fechacreacion;
 private $fechaInicio;
 private $fechaAsignacion;
 private $fechafinalizacion;
 
 function getFechaInicio() {
     return $this->fechaInicio;
 }

 function getFechaAsignacion() {
     return $this->fechaAsignacion;
 }

 function getFechafinalizacion() {
     return $this->fechafinalizacion;
 }

 function setFechaInicio($fechaInicio) {
     $this->fechaInicio = $fechaInicio;
 }

 function setFechaAsignacion($fechaAsignacion) {
     $this->fechaAsignacion = $fechaAsignacion;
 }

 function setFechafinalizacion($fechafinalizacion) {
     $this->fechafinalizacion = $fechafinalizacion;
 }

  
 function getIduser() {
     return $this->iduser;
 }

 function getPerfil_idperfil() {
     return $this->perfil_idperfil;
 }

 function getUsername() {
     return $this->username;
 }

 function getPassword() {
     return $this->password;
 }

 function getNombre() {
     return $this->nombre;
 }

 function getApellido() {
     return $this->apellido;
 }

 function getEmail() {
     return $this->email;
 }

 function getFechacreacion() {
     return $this->fechacreacion;
 }

 function setIduser($iduser) {
     $this->iduser = $iduser;
 }

 function setPerfil_idperfil($perfil_idperfil) {
     $this->perfil_idperfil = $perfil_idperfil;
 }

 function setUsername($username) {
     $this->username = $username;
 }

 function setPassword($password) {
     $this->password = $password;
 }

 function setNombre($nombre) {
     $this->nombre = $nombre;
 }

 function setApellido($apellido) {
     $this->apellido = $apellido;
 }

 function setEmail($email) {
     $this->email = $email;
 }

 function setFechacreacion($fechacreacion) {
     $this->fechacreacion = $fechacreacion;
 }


    
}
