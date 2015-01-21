
function showFormSimulator(tipo, cantidad, ensayo_id, usuario_id, t_dependencia, intento){    
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Alumno&accion=listarSimuladorGenerate&tipo="+tipo+"&cantidad="+cantidad+"&ensayo_id="+ensayo_id+"&usuario_id="+usuario_id+"&t_dependencia="+t_dependencia+"&intento="+intento,
            success: function(r){   
            	
                	location.href="_proxy.php?controlador=Alumno&accion=listarPreguntas&simulacion_id="+r;
                
            }           
         });  
}
