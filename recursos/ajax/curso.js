function showFormCurso(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Curso&accion=formCurso",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditCurso(idacurso){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Curso&accion=formEditCurso&cursoid="+idacurso,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}