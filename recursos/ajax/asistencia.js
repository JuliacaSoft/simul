//PRODUCTO
$(document).ready(function() {
    $("#validar").validate({
        rules: {
            nombre: {
                required:true
            }
        },
        messages: {
            nombre:{
                required:"<br>Ingresar nombre"
            }
        }
    });
});

function insAsis(){
    
if($("#codigo").val().length>0){
var goParameter="&codigo="+$("#codigo").val();
    $("#msg").show("none");
   // alert(goParameter);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Asistencia&accion=asisSave"+goParameter,
            success: function(r){               
             var go=r.split("|");                
           //  alert(go[1]); 
             if(go[0]=="1"){                 
               $("#msg").html(go[1]);  
               $("#msg").show("normal");
             }else{
               $("#msg").html(go[1]);  
               $("#msg").show("normal");                 
             }            
            }           
         });   
    }else{
    $("#msg").html("Por favor lecture su codigo");  
    $("#msg").show("normal");          
    }
}