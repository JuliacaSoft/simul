function showFormRole(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Role&accion=formRole",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditRole(idarole){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Role&accion=formEditRole&roleid="+idarole,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}