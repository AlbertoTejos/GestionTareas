<?php

class informeDAO extends Model {

    protected $_conexion;

    public function exeSQL($sql) {
        try {
            $this->_db->consulta($sql);
            return 'OK';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getInformeHorasByProfesional($fchIni, $fchFin) {
        
        
        
        $sql = "set @fechaDesde = " . "'$fchIni'" .
                "; set @fechahasta = " . "'$fchFin'" .
                "; call PA_InformeHoras(@fechaDesde, @fechahasta);";
           
        $this->_db->consultaSP($sql);
        /* if($this->_db->numRows($datos)>0)
          { */

        $tpoProfesionalArray = $this->_db->fetchAllSP();
        $finallyArray = array();


        foreach ($tpoProfesionalArray as $usdb) {
            $tpoProfesional = new informeDTO();

            $tpoProfesional->setIdProfesional(trim($usdb['profesional']));
            $tpoProfesional->setTipo(trim($usdb['prof']));
            $tpoProfesional->setHrs(trim($usdb['Horas']));
            $tpoProfesional->setSobreEsfuerzo(trim($usdb['Sobre_Esfuerzo']));
            $tpoProfesional->setFallas(trim($usdb['Fallas']));
            $tpoProfesional->setIncidencias(trim($usdb['Incidencias']));
            $tpoProfesional->setMejoras(trim($usdb['Mejoras']));

            $finallyArray[] = $tpoProfesional;
        }
        
        

        return $finallyArray;
    }

    public function getInformeHorasByTpoProfesional($fchIni, $fchFin) {
        
        $sql = "set @fechaDesde = " . "'$fchIni'" .
                "; set @fechahasta = " . "'$fchFin'" .
                "; call PA_InformeHoras(@fechaDesde, @fechahasta);";
        
        
        $this->_db->consultaSP($sql);
        /* if($this->_db->numRows($datos)>0)
          { */

        $tpoProfesionalArray = $this->_db->fetchAllSP();
        $finallyArray = array();


        foreach ($tpoProfesionalArray as $usdb) {
            $tpoProfesional = new informeDTO();

            $tpoProfesional->setIdProfesional(trim($usdb['profesional']));
            $tpoProfesional->setTipo(trim($usdb['prof']));
            $tpoProfesional->setHrs(trim($usdb['Horas']));
            $tpoProfesional->setSobreEsfuerzo(trim($usdb['Sobre_Esfuerzo']));
            $tpoProfesional->setFallas(trim($usdb['Fallas']));
            $tpoProfesional->setIncidencias(trim($usdb['Incidencias']));
            $tpoProfesional->setMejoras(trim($usdb['Mejoras']));

            $finallyArray[] = $tpoProfesional;
        }

        return $finallyArray;
    }

//         $sql = " call gestion.PA_InformeHoras('20160301', '20160331')";
//        $this->_db->consulta($sql); 
//        $datos = $this->_db->consulta($sql);
//                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      $tpoProfesionalArray = $this->_db->fetchAllSP($datos);
//                $finallyArray = array();
//                foreach ($tpoProfesionalArray as $usdb)
//                    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
//                                                       
//                    echo(trim($usdb['profesional']));
//                    $tpoProfesional = new informeDTO();
//                        
//                        $tpoProfesional->setIdProfesional(trim($usdb['profesional']));
//                        $tpoProfesional->setTipo(trim($usdb['prof']));
//                        $tpoProfesional->setHrs(trim($usdb['Horas'])); 
//                        $tpoProfesional->setSobreEsfuerzo(trim($usdb['Sobre_Esfuerzo']));
//                        $tpoProfesional->setFallas(trim($usdb['Fallas']));
//                        $tpoProfesional->setIncidencias(trim($usdb['Incidencias']));
//                            $tpoProfesional->setMejoras(trim($usdb['Mejoras']));
//
//                          $finallyArray[] = $tpoProfesional;                                         
//                     }                             
//                return $finallyArray;
}
