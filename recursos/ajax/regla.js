function showFormRegla(){    
     
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Regla&accion=formRegla",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
}
function showFormEditRegla(idaregla){   
   // alert(idussuario);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Regla&accion=formEditRegla&reglaid="+idaregla,
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });  
}