<?php

require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

$sql1="select a.respuesta as correcta, b.respuesta,ordalt from 
       sim_resultado b, pregunta a where b.pregunta_id=a.pregunta_id AND simulacion_id=?";


    //$sql = "SELECT nombre, cant_preg FROM ensayo";
   // $sqlQuery=new SqlQuery($sql1);
    //$respuesta=QueryExecutor::execute($sqlQuery);

        
        try {
            $tabla=0;
            $sqlQuery1 = new SqlQuery($sql1);
            $sqlQuery1->set(1);
            $tabla1 = QueryExecutor::execute($sqlQuery1);
            $respuestanum=array();
            
            for ($i=0; $i<count($tabla1); $i++) { 
                $alternativas=$tabla1[$i]['ordalt'];
                $alt=str_split($alternativas);


                
                    switch ($tabla1[$i]['respuesta']) {
                        case 'A': $tabla1[$i]['respuesta']=1; break;
                        case 'B': $tabla1[$i]['respuesta']=2; break;
                        case 'C': $tabla1[$i]['respuesta']=3; break;
                        case 'D': $tabla1[$i]['respuesta']=4; break;
                    }

                    echo $tabla1[$i]['respuesta']."<BR>";

                //for ($j=0; $j<count($alt); $j++) { 
                    //echo "Array alternativas ".$alt[$j];
                    if(!$tabla1[$i]['respuesta']==0){
                        echo "Array alternativas ".$alt[$tabla1[$i]['respuesta']-1]."<br>";

                        echo "respuesta correcta: ".$tabla1[$i]['correcta']."<br>";
                        if($alt[$tabla1[$i]['respuesta']-1]==$tabla1[$i]['correcta']){
                            $tabla++;
                        }
                    }
                    //if($alt[$tabla1[$i]['respuesta']]==$tabla1[$i]['respuesta']){
                    //    $tabla++;
                    //}
                //}

                
            }
            echo "puntaje final :".$tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
?>