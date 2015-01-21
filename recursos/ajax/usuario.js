function showFormUser(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Usuario&accion=formUser",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditUser(idussuario){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Usuario&accion=formEditUser&usuarioid="+idussuario,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}
