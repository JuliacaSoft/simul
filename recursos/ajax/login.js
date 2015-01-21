/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function newLogin(){    
var goParameter="&txtUsername="+$("#txtUsername").val()+
    "&txtPassword="+$("#txtPassword").val(); 
    //alert(goParameter);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Index&accion=login"+goParameter,
            success: function(r){
            var go=r.split("|");            
            window.location.href=go[1];
            }           
         });    
}

