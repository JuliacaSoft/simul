function showFormPregunta(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Pregunta&accion=formPregunta",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditPregunta(idapregunta){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Pregunta&accion=formEditPregunta&preguntaid="+idapregunta,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}