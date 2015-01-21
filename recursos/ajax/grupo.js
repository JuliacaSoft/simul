function showFormGrupo(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Grupo&accion=formGrupo",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditGrupo(idagrupo){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Grupo&accion=formEditGrupo&grupoid="+idagrupo,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}