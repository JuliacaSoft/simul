<?php

require_once "PreguntaTO.php";
require_once "GrupoTO.php";
require_once "AreaTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class PreguntaDAO {

    public function listarPregunta() {
        $sql = "SELECT * FROM pregunta INNER JOIN (SELECT area_id, nombre FROM area) a USING(area_id) INNER JOIN (SELECT grupo_id,  nombre AS proceso FROM grupo) b USING (grupo_id) ";
        try {
            $sqlQuery = new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function listarPreguntaTwo() {
        $sql = "Select * from pregunta";
        try {
            $sqlQuery = new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $preguntaTO = new PreguntaTO();
                $preguntaTO->setExcel_id($tabla[$a]['excel_id']);
                $preguntaTO->setPregunta_es($tabla[$a]['pregunta_es']);
                //$preguntaTO->setDescripcion($tabla[$a]['descripcion']);                
                $preguntaTO->setNivel_dificultad($tabla[$a]['nivel_dificultad']);
                $preguntaTO->setGrupo_id($tabla[$a]['grupo_id']);
                $preguntaTO->setArea_id($tabla[$a]['area_id']);
                $preguntaTO->setEstado($tabla[$a]['estado']);
                $preguntaTO->setPregunta_id($tabla[$a]['pregunta_id']);
                $list[$a] = $preguntaTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function listarAreas() {
        $sql = "SELECT * FROM area ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $areaTO = new AreaTO();
                $areaTO->setArea_id($tabla[$a]['area_id']);
                $areaTO->setNombre($tabla[$a]['nombre']);
                $list[$a] = $areaTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function listarGrupos() {
        $sql = "SELECT * FROM grupo ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $grupoTO = new GrupoTO();
                $grupoTO->setGrupo_id($tabla[$a]['grupo_id']);
                $grupoTO->setNombre($tabla[$a]['nombre']);
                $list[$a] = $grupoTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function actualizaPregunta($PreguntaTO) {
        $sql = " UPDATE pregunta SET excel_id = ?, pregunta_es = ?, pregunta_us = ?, "
                . " imagen_es = ? , imagen_us = ?, respuesta = ?, "
                . " opcion_aes = ? , opcion_bes = ?, opcion_ces = ?, opcion_des = ?, "
                . " opcion_aus = ? , opcion_bus = ?, opcion_cus = ?, opcion_dus = ?, "
                . " comentario_aes = ? , comentario_bes = ?, comentario_ces = ?, comentario_des = ?, "
                . " comentario_aus = ? , comentario_bus = ?, comentario_cus = ?, comentario_dus = ?, "
                . " nivel_dificultad = ?, grupo_id = ? , area_id = ?, estado = ? WHERE pregunta_id = ? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($PreguntaTO->getExcel_id());
            $sqlQuery->set($PreguntaTO->getPregunta_es());
            $sqlQuery->set($PreguntaTO->getPregunta_us());
            $sqlQuery->set($PreguntaTO->getImagen_es());
            $sqlQuery->set($PreguntaTO->getImagen_us());
            $sqlQuery->set($PreguntaTO->getRespuesta());
            $sqlQuery->set($PreguntaTO->getOpcion_aes());
            $sqlQuery->set($PreguntaTO->getOpcion_bes());
            $sqlQuery->set($PreguntaTO->getOpcion_ces());
            $sqlQuery->set($PreguntaTO->getOpcion_des());
            $sqlQuery->set($PreguntaTO->getOpcion_aus());
            $sqlQuery->set($PreguntaTO->getOpcion_bus());
            $sqlQuery->set($PreguntaTO->getOpcion_cus());
            $sqlQuery->set($PreguntaTO->getOpcion_dus());
            $sqlQuery->set($PreguntaTO->getComentario_aes());
            $sqlQuery->set($PreguntaTO->getComentario_bes());
            $sqlQuery->set($PreguntaTO->getComentario_ces());
            $sqlQuery->set($PreguntaTO->getComentario_des());
            $sqlQuery->set($PreguntaTO->getComentario_aus());
            $sqlQuery->set($PreguntaTO->getComentario_bus());
            $sqlQuery->set($PreguntaTO->getComentario_cus());
            $sqlQuery->set($PreguntaTO->getComentario_dus());
            $sqlQuery->set($PreguntaTO->getNivel_dificultad());
            $sqlQuery->set($PreguntaTO->getGrupo_id());
            $sqlQuery->set($PreguntaTO->getArea_id());
            $sqlQuery->set($PreguntaTO->getEstado());
            $sqlQuery->set($PreguntaTO->getPregunta_id());
            $resp = QueryExecutor::executeUpdate($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function eliminarPregunta($preguntaid) {
        $sql = "delete from pregunta where pregunta_id = ?  ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($preguntaid);
            QueryExecutor::executeDelete($sqlQuery);
            $resp = 1;
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function buscarIdPregunta($id) {
        $sql = "select * from pregunta where pregunta_id = ? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $preguntaTO = new PreguntaTO();
                $preguntaTO->setExcel_id($tabla[$a]['excel_id']);
                $preguntaTO->setPregunta_es($tabla[$a]['pregunta_es']);
                $preguntaTO->setPregunta_us($tabla[$a]['pregunta_us']);
                $preguntaTO->setImagen_es($tabla[$a]['imagen_es']);
                $preguntaTO->setImagen_us($tabla[$a]['imagen_us']);
                $preguntaTO->setRespuesta($tabla[$a]['respuesta']);
                $preguntaTO->setOpcion_aes($tabla[$a]['opcion_aes']);
                $preguntaTO->setOpcion_bes($tabla[$a]['opcion_bes']);
                $preguntaTO->setOpcion_ces($tabla[$a]['opcion_ces']);
                $preguntaTO->setOpcion_des($tabla[$a]['opcion_des']);
                $preguntaTO->setOpcion_aus($tabla[$a]['opcion_aus']);
                $preguntaTO->setOpcion_bus($tabla[$a]['opcion_bus']);
                $preguntaTO->setOpcion_cus($tabla[$a]['opcion_cus']);
                $preguntaTO->setOpcion_dus($tabla[$a]['opcion_dus']);
                $preguntaTO->setComentario_aes($tabla[$a]['comentario_aes']);
                $preguntaTO->setComentario_bes($tabla[$a]['comentario_bes']);
                $preguntaTO->setComentario_ces($tabla[$a]['comentario_ces']);
                $preguntaTO->setComentario_des($tabla[$a]['comentario_des']);
                $preguntaTO->setComentario_aus($tabla[$a]['comentario_aus']);
                $preguntaTO->setComentario_bus($tabla[$a]['comentario_bus']);
                $preguntaTO->setComentario_cus($tabla[$a]['comentario_cus']);
                $preguntaTO->setComentario_dus($tabla[$a]['comentario_dus']);
                $preguntaTO->setNivel_dificultad($tabla[$a]['nivel_dificultad']);
                $preguntaTO->setGrupo_id($tabla[$a]['grupo_id']);
                $preguntaTO->setArea_id($tabla[$a]['area_id']);
                $preguntaTO->setEstado($tabla[$a]['estado']);
                $preguntaTO->setPregunta_id($tabla[$a]['pregunta_id']);
                $list[$a] = $preguntaTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function buscarDatosPregunta($datos) {
        $sql = "SELECT * FROM pregunta INNER JOIN (SELECT area_id, nombre FROM area) a USING(area_id) INNER JOIN (SELECT grupo_id,  nombre AS proceso FROM grupo) b USING (grupo_id) WHERE UPPER(CONCAT(pregunta_es,' ', excel_id)) LIKE UPPER('%" . $datos . "%')";
        try {
            $sqlQuery = new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function buscarDatosPreguntaAuto($datos) {
        $sql = "SELECT * FROM pregunta WHERE UPPER(CONCAT(pregunta_es,' ', excel_id)) LIKE UPPER('%" . $datos . "%')";
        try {
            $sqlQuery = new SqlQuery($sql);
            //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function registrarPregunta($PreguntaTO) {
        $sql = "INSERT INTO pregunta ( excel_id, pregunta_es, pregunta_us, imagen_es, imagen_us, respuesta, opcion_aes, "
                . " opcion_bes, opcion_ces, opcion_des, opcion_aus, opcion_bus, opcion_cus, opcion_dus, "
                . "comentario_aes, comentario_bes, comentario_ces, comentario_des, comentario_aus, "
                . "comentario_bus, comentario_cus, comentario_dus, nivel_dificultad, estado, area_id, grupo_id)"
                . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?) ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($PreguntaTO->getExcel_id());
            $sqlQuery->set($PreguntaTO->getPregunta_es());
            $sqlQuery->set($PreguntaTO->getPregunta_us());
            $sqlQuery->set($PreguntaTO->getImagen_es());
            $sqlQuery->set($PreguntaTO->getImagen_us());
            $sqlQuery->set($PreguntaTO->getRespuesta());
            $sqlQuery->set($PreguntaTO->getOpcion_aes());
            $sqlQuery->set($PreguntaTO->getOpcion_bes());
            $sqlQuery->set($PreguntaTO->getOpcion_ces());
            $sqlQuery->set($PreguntaTO->getOpcion_des());
            $sqlQuery->set($PreguntaTO->getOpcion_aus());
            $sqlQuery->set($PreguntaTO->getOpcion_bus());
            $sqlQuery->set($PreguntaTO->getOpcion_cus());
            $sqlQuery->set($PreguntaTO->getOpcion_dus());
            $sqlQuery->set($PreguntaTO->getComentario_aes());
            $sqlQuery->set($PreguntaTO->getComentario_bes());
            $sqlQuery->set($PreguntaTO->getComentario_ces());
            $sqlQuery->set($PreguntaTO->getComentario_des());
            $sqlQuery->set($PreguntaTO->getComentario_aus());
            $sqlQuery->set($PreguntaTO->getComentario_bus());
            $sqlQuery->set($PreguntaTO->getComentario_cus());
            $sqlQuery->set($PreguntaTO->getComentario_dus());
            $sqlQuery->set($PreguntaTO->getNivel_dificultad());
            $sqlQuery->set($PreguntaTO->getEstado());
            $sqlQuery->set($PreguntaTO->getArea_id());
            $sqlQuery->set($PreguntaTO->getGrupo_id());

            $resp = QueryExecutor::executeInsert($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    function sheetData($sheet) {
        $x = 1;
        $PreguntaTO = null;
        $dao = null;
        while ($x <= $sheet['numRows']) {
            $PreguntaTO = new PreguntaTO();
            // $y = 1;
            // while($y <= $sheet['numCols']) {              
            //$cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
            //echo isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : ''+"\n";


            $PreguntaTO->setExcel_id(isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : '');
            $PreguntaTO->setPregunta_es(isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : '');
            $PreguntaTO->setPregunta_us(isset($sheet['cells'][$x][3]) ? $sheet['cells'][$x][3] : '');
            $PreguntaTO->setImagen_es(isset($sheet['cells'][$x][4]) ? $sheet['cells'][$x][4] : '');
            $PreguntaTO->setImagen_us(isset($sheet['cells'][$x][5]) ? $sheet['cells'][$x][5] : '');
            $PreguntaTO->setRespuesta(isset($sheet['cells'][$x][6]) ? $sheet['cells'][$x][6] : '');
            $PreguntaTO->setOpcion_aes(isset($sheet['cells'][$x][7]) ? $sheet['cells'][$x][7] : '');
            $PreguntaTO->setOpcion_bes(isset($sheet['cells'][$x][8]) ? $sheet['cells'][$x][8] : '');
            $PreguntaTO->setOpcion_ces(isset($sheet['cells'][$x][9]) ? $sheet['cells'][$x][9] : '');
            $PreguntaTO->setOpcion_des(isset($sheet['cells'][$x][10]) ? $sheet['cells'][$x][10] : '');
            $PreguntaTO->setOpcion_aus(isset($sheet['cells'][$x][11]) ? $sheet['cells'][$x][11] : '');
            $PreguntaTO->setOpcion_bus(isset($sheet['cells'][$x][12]) ? $sheet['cells'][$x][12] : '');
            $PreguntaTO->setOpcion_cus(isset($sheet['cells'][$x][13]) ? $sheet['cells'][$x][13] : '');
            $PreguntaTO->setOpcion_dus(isset($sheet['cells'][$x][14]) ? $sheet['cells'][$x][14] : '');
            $PreguntaTO->setComentario_aes(isset($sheet['cells'][$x][15]) ? $sheet['cells'][$x][15] : '');
            $PreguntaTO->setComentario_bes(isset($sheet['cells'][$x][16]) ? $sheet['cells'][$x][16] : '');
            $PreguntaTO->setComentario_ces(isset($sheet['cells'][$x][17]) ? $sheet['cells'][$x][17] : '');
            $PreguntaTO->setComentario_des(isset($sheet['cells'][$x][18]) ? $sheet['cells'][$x][18] : '');
            $PreguntaTO->setComentario_aus(isset($sheet['cells'][$x][19]) ? $sheet['cells'][$x][19] : '');
            $PreguntaTO->setComentario_bus(isset($sheet['cells'][$x][20]) ? $sheet['cells'][$x][20] : '');
            $PreguntaTO->setComentario_cus(isset($sheet['cells'][$x][21]) ? $sheet['cells'][$x][21] : '');
            $PreguntaTO->setComentario_dus(isset($sheet['cells'][$x][22]) ? $sheet['cells'][$x][22] : '');
            $PreguntaTO->setNivel_dificultad(isset($sheet['cells'][$x][23]) ? $sheet['cells'][$x][23] : '');
            $PreguntaTO->setEstado(isset($sheet['cells'][$x][24]) ? $sheet['cells'][$x][24] : 0);
            $PreguntaTO->setArea_id(isset($sheet['cells'][$x][25]) ? $sheet['cells'][$x][25] : 0);
            $PreguntaTO->setGrupo_id(isset($sheet['cells'][$x][26]) ? $sheet['cells'][$x][26] : 0);
            // $y++;
            // }  
            $dao = new PreguntaDAO();
            $dao->registrarPregunta($PreguntaTO);
            $x++;
        }
    }

    public function reportarPreguntaSimulation($simulacion_id) {
        $sql = "SELECT * FROM (SELECT sim_resultado.sim_resultado_id, sim_resultado.ordalt, revision,sim_resultado.respuesta as marcado, sim_resultado.simulacion_id, pregunta_id, estado AS condicion , ensayo_id FROM sim_resultado , simulacion WHERE simulacion.simulacion_id=sim_resultado.simulacion_id and  sim_resultado.simulacion_id=? AND estado=0) a INNER JOIN pregunta USING(pregunta_id)  ";


        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            /* $list=array();
              for ($a = 0; $a < count($tabla); $a++) {
              $preguntaTO = new PreguntaTO();

              $preguntaTO->setPregunta_es($tabla[$a]['pregunta_es']);
              $preguntaTO->setPregunta_us($tabla[$a]['pregunta_us']);

              $preguntaTO->setOpcion_aes($tabla[$a]['opcion_aes']);
              $preguntaTO->setOpcion_bes($tabla[$a]['opcion_bes']);
              $preguntaTO->setOpcion_ces($tabla[$a]['opcion_ces']);
              $preguntaTO->setOpcion_des($tabla[$a]['opcion_des']);
              $preguntaTO->setOpcion_aus($tabla[$a]['opcion_aus']);
              $preguntaTO->setOpcion_bus($tabla[$a]['opcion_bus']);
              $preguntaTO->setOpcion_cus($tabla[$a]['opcion_cus']);
              $preguntaTO->setOpcion_dus($tabla[$a]['opcion_dus']);
              //$preguntaTO->setGrupo_id($tabla[$a]['grupo_id']);
              //$preguntaTO->setArea_id($tabla[$a]['area_id']);
              $preguntaTO->setPregunta_id($tabla[$a]['pregunta_id']);
              $list[$a]=$preguntaTO;
              } */
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function reportarPreguntaSimulationRev($simulacion_id) {
        $sql = "SELECT * FROM (SELECT sim_resultado.sim_resultado_id, revision,respuesta, sim_resultado.simulacion_id, pregunta_id, estado AS condicion , ensayo_id FROM sim_resultado , simulacion WHERE simulacion.simulacion_id=sim_resultado.simulacion_id and  sim_resultado.simulacion_id=? AND estado=0) a INNER JOIN pregunta USING(pregunta_id)";

        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }
    public function reportarPreguntaSimulationRev2($simulacion_id) {
        $sql = "select  *  from sim_resultado sir, simulacion si, pregunta pr where si.simulacion_id=sir.simulacion_id and pr.pregunta_id=sir.pregunta_id  and sir.revision=1 and si.simulacion_id=? ;";
         try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function reportarPreguntasSimulationRevision($simulacion_id) {
        $sql = "select  sir.sim_resultado_id, sir.revision, sir.respuesta as marcado, sir.simulacion_id,sir.estado,sir.estado AS condicion, si.ensayo_id, sir.ordalt,pr.pregunta_id,pr.pregunta_es,pr.pregunta_us,pr.respuesta,pr.opcion_aes,pr.opcion_bes,pr.opcion_ces,pr.opcion_des,pr.opcion_aus,pr.opcion_bus,pr.opcion_cus,pr.opcion_dus 
        from sim_resultado sir, simulacion si, pregunta pr 
        where si.simulacion_id=sir.simulacion_id and pr.pregunta_id=sir.pregunta_id and  sir.simulacion_id=? and sir.estado = 0";


        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function reportarPregungtasSimulationRev($simulacion_id,$ini) {
        $sql = "select  sir.simulacion_id,sir.revision,sir.estado,sir.respuesta as marcado,ordalt,revision,pregunta_es,pregunta_us,pr.respuesta,opcion_aes,opcion_bes,opcion_ces,opcion_des,opcion_aus,opcion_bus,opcion_cus,opcion_dus 
        from sim_resultado sir, simulacion si, pregunta pr 
        where si.simulacion_id=sir.simulacion_id and pr.pregunta_id=sir.pregunta_id and  si.simulacion_id=? limit $ini,1";


        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function reportarCantidadRevision($simulacion_id) {
        $sql = "SELECT COUNT(*) AS cantidadrev FROM (SELECT sim_resultado_id, revision,respuesta, simulacion_id, pregunta_id, estado AS condicion FROM sim_resultado WHERE simulacion_id=? AND revision=1) a INNER JOIN pregunta USING(pregunta_id)  ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function ultimasimulacionUsuario($usuario_id) {
        $sql = "select * from simulacion si where si.simulacion_id=(select max(simulacion_id) from simulacion where usuario_id=?)  ";
         try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($usuario_id);
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function estadoSimulacion($usuario_id){
        $sql="select max(si.simulacion_id) as estadosim from simulacion si , usuario us WHERE us.usuario_id=si.usuario_id and si.estado_sim=0 and us.usuario_id=?";
        
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usuario_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
        
    }
    
    public function listarCursosEnsayo($usuario_id) {
        $sql = "SELECT e.ensayo_id, c.nombre AS curso, e.nombre,  e.tipo, e.t_dependencia, e.tiempo, e.intento, e.cant_preg, (select count(si.simulacion_id) from simulacion si where si.estado_sim=1 and si.ensayo_id=e.ensayo_id and si.usuario_id=? ) as ensreal ,(select max(si.simulacion_id) from simulacion si, usuario us where si.estado_sim=0 and us.usuario_id=si.usuario_id and si.ensayo_id=e.ensayo_id and us.usuario_id=? ) idsim  FROM ensayo e, curso c WHERE e.curso_id=c.curso_id ;
 ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usuario_id);
            $sqlQuery->set($usuario_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function listarCursosEnsayoTerminado($usuario_id) {
        $sql = " select en.nombre as curso, si.simulacion_id as simulacion_id, us.nombre , en.tiempo, en.cant_preg, si.simulacion_id as intento from simulacion si, ensayo en, curso cu, usuario us where en.ensayo_id=si.ensayo_id and en.curso_id=cu.curso_id and si.usuario_id=us.usuario_id and si.estado_sim=1 and us.usuario_id=?";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($usuario_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function generarSimulacionX($tipo, $cantidad, $ensayo_id, $usuario_id, $t_dependencia) {
        $sql = " SELECT simulador.estado_simulacion(?,?,?,?,?)  as condicion ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->setNumber($tipo);
            $sqlQuery->setNumber($cantidad);
            $sqlQuery->setNumber($ensayo_id);
            $sqlQuery->setNumber($usuario_id);
            $sqlQuery->setString($t_dependencia);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function actualizaSimulPregunta($simulacion_id, $pregunta_id, $respuesta, $estado, $ordenalternativas, $revision) {
        $sql = " UPDATE sim_resultado  SET respuesta = ? , estado = ?, ordalt= ?, revision=? WHERE simulacion_id = ? AND pregunta_id = ?  ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($respuesta);
            $sqlQuery->set($estado);
            $sqlQuery->set($ordenalternativas);
            $sqlQuery->set($revision);
            $sqlQuery->set($simulacion_id);
            $sqlQuery->set($pregunta_id);
            $resp = QueryExecutor::executeUpdate($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function actualizaSimulPreguntaRev($simulacion_id, $pregunta_id, $respuesta, $estado,  $revision) {
        $sql = " UPDATE sim_resultado  SET respuesta = ? , estado = ?, revision=? WHERE simulacion_id = ? AND pregunta_id = ?  ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($respuesta);
            $sqlQuery->set($estado);
            $sqlQuery->set($revision);
            $sqlQuery->set($simulacion_id);
            $sqlQuery->set($pregunta_id);
            $resp = QueryExecutor::executeUpdate($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }
    public function actualizarRevision($simulacion_id) {
        $sql = " UPDATE sim_resultado set estado=0 where revision=1 and simulacion_id=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $resp = QueryExecutor::executeUpdate($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function totalSimulacionRes($simulacion_id) {
        $sql = "select count(*) as totalSim from usuario us, simulacion si, sim_resultado sir  where us.usuario_id=si.usuario_id and si.simulacion_id = sir.simulacion_id and si.simulacion_id=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function tiempoSimulacion($simulacion_id) {
        $sql = "select fin_fecha as tiempofin from usuario us, simulacion si, sim_resultado sir  where us.usuario_id=si.usuario_id and si.simulacion_id = sir.simulacion_id and si.simulacion_id=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function totalSimulacionContestadas($simulacion_id, $estado) {
        $sql = "select count(*) as totalCont from usuario us, simulacion si, sim_resultado sir  where us.usuario_id=si.usuario_id and si.simulacion_id = sir.simulacion_id and si.simulacion_id=? and sir.estado=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $sqlQuery->set($estado);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function totalSimulacionContestadasRev($simulacion_id, $revision) {
        $sql = "select count(*) as totalrev from usuario us, simulacion si, sim_resultado sir  where us.usuario_id=si.usuario_id and si.simulacion_id = sir.simulacion_id and si.simulacion_id=? and sir.revision=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $sqlQuery->set($revision);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function totalSimulacionContestadasPerdidas($simulacion_id) {
        $sql = "select count(*) as totalCont from usuario us, simulacion si, sim_resultado sir  where us.usuario_id=si.usuario_id and si.simulacion_id = sir.simulacion_id and si.simulacion_id=? and sir.revision=0 and sir.estado=1";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);

            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function finSimulacion($simulacion_id, $resto, $contestado, $puntaje, $porcentaje) {
        $sql = "UPDATE simulacion SET estado_sim = 1,restante=? , respondida=?, puntaje=? , punt_porcentual=? WHERE simulacion_id = ?   ";
        try {
            $sqlQuery = new SqlQuery($sql);
            //$sqlQuery->set($estado_sim);   
            $sqlQuery->set($resto);
            $sqlQuery->set($contestado);
            $sqlQuery->set($puntaje);
            $sqlQuery->set($porcentaje);
            $sqlQuery->set($simulacion_id);

            $resp = QueryExecutor::executeUpdate($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function puntaje($simulacion_id) {
        $sql = "select count(*) as puntaje from sim_resultado simr, pregunta pr where  simr.estado=2 and pr.respuesta = simr.respuesta and pr.pregunta_id=simr.pregunta_id and simr.simulacion_id=? ";

        $sql1 = "select a.respuesta as correcta, b.respuesta,ordalt from 
       sim_resultado b, pregunta a where b.pregunta_id=a.pregunta_id AND simulacion_id=?";


        //$sql = "SELECT nombre, cant_preg FROM ensayo";
        // $sqlQuery=new SqlQuery($sql1);
        //$respuesta=QueryExecutor::execute($sqlQuery);


        try {
            $tabla = 0;
            $sqlQuery1 = new SqlQuery($sql1);
            $sqlQuery1->set($simulacion_id);
            $tabla1 = QueryExecutor::execute($sqlQuery1);
            $respuestanum = array();

            for ($i = 0; $i < count($tabla1); $i++) {
                $alternativas = $tabla1[$i]['ordalt'];
                $alt = str_split($alternativas);



                switch ($tabla1[$i]['respuesta']) {
                    case 'A': $tabla1[$i]['respuesta'] = 1;
                        break;
                    case 'B': $tabla1[$i]['respuesta'] = 2;
                        break;
                    case 'C': $tabla1[$i]['respuesta'] = 3;
                        break;
                    case 'D': $tabla1[$i]['respuesta'] = 4;
                        break;
                }

                //echo $tabla1[$i]['respuesta']."<BR>";
                //for ($j=0; $j<count($alt); $j++) { 
                //echo "Array alternativas ".$alt[$j];
                if (!$tabla1[$i]['respuesta'] == 0) {
                    //echo "Array alternativas ".$alt[$tabla1[$i]['respuesta']-1]."<br>";
                    //echo "respuesta correcta: ".$tabla1[$i]['correcta']."<br>";
                    if ($alt[$tabla1[$i]['respuesta'] - 1] == $tabla1[$i]['correcta']) {
                        $tabla++;
                    }
                }
                //if($alt[$tabla1[$i]['respuesta']]==$tabla1[$i]['respuesta']){
                //    $tabla++;
                //}
                //}
            }
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function validarCantidadEnsayo($idUsuario, $idEnsayo) {
        $sql = "select count(*) from usuario us, simulacion si, ensayo en WHERE us.usuario_id = si.usuario_id and en.ensayo_id=si.ensayo_id and us.usuario_id=? and en.ensayo_id=?";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($idUsuario);
            $sqlQuery->set($idEnsayo);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function mostrarCantidadIntento($ensayo_id) {
        $sql = "select count(si.simulacion_id) as contar, en.*  from simulacion si, ensayo en where en.ensayo_id=si.ensayo_id and en.ensayo_id=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($ensayo_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function validarAprobacion($simulacion_id) {
        $sql = "select * from ensayo en , simulacion si where si.ensayo_id = en.ensayo_id and si.simulacion_id=?";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($simulacion_id);
            $tabla = QueryExecutor::execute($sqlQuery);
            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function verificarTiempoCurso(){  //metodo para cambiar el estado de las simulaciones a 1 si su tiempo se a terminado
        $sql = "SELECT simulacion_id, IF(now()>fin_fecha,'terminado','proceso') AS estadotiempo FROM ensayo e, curso c, simulacion s  
        WHERE e.curso_id=c.curso_id  AND e.ensayo_id=s.ensayo_id";
        try {
            $sqlQuery = new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);

            for ($i = 0; $i < count($tabla); $i++) {
                if($tabla[$i]['estadotiempo']=="terminado"){
                    $simulacion_id=$tabla[$i]['simulacion_id'];
                    $sql2 = "UPDATE simulacion SET estado_sim = 1 WHERE simulacion_id = ?  ";
                    $sqlQuery2 = new SqlQuery($sql2);
                    $sqlQuery2->set($simulacion_id);
                    $resp = QueryExecutor::executeUpdate($sqlQuery2);
                }
            }
 
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }

    }

}

?>
