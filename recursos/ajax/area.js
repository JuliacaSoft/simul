function showFormArea(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Area&accion=formArea",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditArea(idaarea){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Area&accion=formEditArea&areaid="+idaarea,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}