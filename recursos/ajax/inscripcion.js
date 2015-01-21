/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* $().ready(function() {
    $('#placa').autocomplete('GoVehiculo', {
    delay: 400,
    minChars: 2,
    matchSubset:10,
    matchContains:1,
    cacheLength:10,
    formatItem: function (row){
    return "<span style='font-size:10px'>" + row[0] + ".</span>";
    },
    extraParams:{
        opt:7
    },
    autoFill:true
});
});*/

function foto(viewFoto, img, e){       
    if(img!="null"){
    $("#fotoview").attr("src","../../recursos/files/"+img);
    }else{
    $("#fotoview").attr("src","../../recursos/files/63_Imagen1.png");    
    }       
    $("#"+$.trim(viewFoto)).css("top",""+((e.clientY))+"px");
    $("#"+$.trim(viewFoto)).css("right",""+250+"px");
    $('#'+$.trim(viewFoto)).show('slow');                
}

function newForm(){        
$("#msg").show("none");
$("#myDiv").html('<img src="../../recursos/imagen/loading.gif"> Espere un momento...esta registrando...!');
var goParameter="&nombre="+$("#nombre").val()+
    "&apellpaterno="+$("#apellpaterno").val()+
    "&apellmaterno="+$("#apellmaterno").val()+
    "&sexo="+$("#sexo").val()+
    "&dnicedula="+$.trim($("#dnicedula").val())+
    "&email="+$("#email").val()+
    "&celular="+$("#celular").val()+
    "&pais="+$("#pais").val()+
    "&region="+$("#region").val()+
    "&tipo="+$("#tipo").val()+
    "&institucion="+$("#institucion").val()+
    "&area="+$("#area").val()+
    "&nivel="+$("#nivel").val()+
    "&institucion="+$("#institucion").val();
   // alert(goParameter);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Inscripcion&accion=insSave"+goParameter,
            success: function(r){
            var go=r.split("|"); 
            if(go[0]=="1"){                
            $("#msg").show("none");
            window.location.href=go[1];
            }else{
                $("#msg").html(go[1]);
                $("#msg").show("normal");                
            }
            }           
         });    
}

function newConfirm(){    
var goParameter="&numdep="+$("#numdep").val()+
    "&idInscrito="+$("#idInscrito").val(); 
    //alert(goParameter);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Confirmacion&accion=confSave"+goParameter,
            success: function(r){
            var go=r.split("|");            
            window.location.href=go[1];
            }           
         });    
}






function enviar(){
    $("#valid").submit();    
}
function regionMB(){
var goParameter="&pais="+$("#pais").val(); 
    
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Inscripcion&accion=viewRegion"+goParameter,
            success: function(r){                        
            $("#region").html(r);
            }           
         });   
}


function impNd(){        
if($.trim($("#numdep").val()).length>0){
var goParameter="&numdep="+$("#numdep").val();    
   // alert(goParameter);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Confirmacion&accion=impSave"+goParameter,
            success: function(r){
            var go=r.split("|");            
            window.location.href=go[3]+"&msg="+go[1]+"&num="+go[2]+"&msgr="+go[4];
            }           
         });    
         }else{
                $("#numdep").focus();
                $("#numdep").val("");              
            alert("El Text Area debe tener Valor")
         }
}


function preConfirm(){    
    $("#msg").show("none");
    var goParameter="&dni="+$("#dni").val()+
    "&clave="+$("#clave").val(); 
   // alert(goParameter);
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data:"controlador=Confirmacion&accion=preSave"+goParameter,
            success: function(r){
            var go=r.split("|"); 
            if(go[0]=="1"){                
            $("#msg").show("none");
            window.location.href=go[1];
            }else{
                $("#msg").html(go[1]);
                $("#msg").show("normal");                
            }
            }           
         });    
}

    function closeX(parametro){
        var campos = parametro.split(",");
        for (x=0; x< campos.length; x++){
        $("#"+campos[x]).hide();
        }
       // $('#bgtransparent').remove();
    }

//   function foto(viewFoto, img, e){       
//       if(img!="null"){
//        $("#fotoview").attr("src","../../resource/imagen/vehiculo/"+img);
//        }else{
//        $("#fotoview").attr("src","../../resource/imagen/vehiculo/vehiculo.jpg");    
//        }       
//        $("#"+$.trim(viewFoto)).css("top",""+((e.clientY))+"px");
//        $("#"+$.trim(viewFoto)).css("right",""+250+"px");
//        $('#'+$.trim(viewFoto)).show('slow');                
//   }






















//      
//        function probarFormV(opt, nombre, nombrep){            
//            var goParameter="&q="+$.trim($("#"+$.trim(nombre)).val()); 
//                    var valor= $.ajax({
//                        url: "GoVehiculo",
//                        type: "POST",
//                        data:"opt="+opt+goParameter,
//                        async: false 
//                    }).responseText;        
//                    if($.trim(valor).length!=0){               
//                    $("#"+$.trim(nombre)).val(""); 
//                    $("#"+$.trim(nombrep)).html("Existe!"); 
//                    }else{
//                    $("#"+$.trim(nombrep)).html("");
//                    }   
//        }
//
//
//        //Autocomplete Inicios
//         $().ready(function() {
//         $('#placab').autocomplete('GoVehiculo', {
//            delay:400,
//            minChars:2,
//            matchSubset:10,
//            matchContains:1,
//            cacheLength:10,
//            formatItem: function (row){
//                return "<span style='font-size:10px'>" + row[0] + ".</span>";
//            },
//            extraParams:{
//                opt:6
//            },
//            autoFill:true,
//            onItemSelect: function(e){
//                $("#formBuscar").submit(); 
//            }            
//        });
//        });

        //Autocomplete Fin
        
//   function formVehiculoNew(divFormAcceso, title, opt, e){       
//       ventanaTransparente();
//        $("#"+$.trim(title)).html("Crear Vehículo");     
//        $("#"+$.trim(opt)).val("1");  
//        $("#v_placa").val("");
//        $("#v_volumen").val("");      
//        $("#v_peso").val("");      
//        $("#v_distancia").val("");      
//        $("#v_estado").val("");             
//        $("#v_foto").val(""); 
//        $("#v_vehiculoId").val("");          
//        $("#"+$.trim(divFormAcceso)).css("top",""+((e.clientY))+"px");
//        $("#"+$.trim(divFormAcceso)).css("right",""+250+"px");
//        $('#'+$.trim(divFormAcceso)).show('slow');               
//   }     
//   function formVehiculoFoto(formVehiculoFoto, url,id,placa, e){       
//       ventanaTransparente();  
//       $("#placa").html(placa);
//       $("#fotoForm").attr("action",url+"?nombre="+id);
//        $("#"+$.trim(formVehiculoFoto)).css("top",""+((e.clientY))+"px");
//        $("#"+$.trim(formVehiculoFoto)).css("right",""+250+"px");
//        $('#'+$.trim(formVehiculoFoto)).show('slow');               
//   }     
//   
   

//   
//   function formVehiculoEdit(divFormAcceso, title, opt,placa, volumen, peso, distancia, estado, vehiculoId, e){       
//        ventanaTransparente();
//        $("#"+$.trim(title)).html("Actualizar Vehículo");     
//        $("#"+$.trim(opt)).val("2");  
//        $("#v_placa").val(placa);
//        $("#v_volumen").val(volumen);      
//        $("#v_peso").val(peso);      
//        $("#v_distancia").val(distancia);      
//        $("#v_estado").val(estado);  
//        $("#foto_car").hide();
//        $("#v_vehiculoId").val(vehiculoId);            
//        $("#"+$.trim(divFormAcceso)).css("top",""+((e.clientY))+"px");
//        $("#"+$.trim(divFormAcceso)).css("right",""+250+"px");
//        $('#'+$.trim(divFormAcceso)).show('slow');
//        $("#"+$.trim(divFormAcceso)).show();      
//   }     
//
//   function validarAccionVehiculo(opt,placa, volumen,peso,distancia, estado,vehiculoId ){    
//     
//    var accion=false;        
//    var goParameter="&placa="+$("#"+$.trim(placa)).val()
//            +"&volumen="+$("#"+$.trim(volumen)).val()
//            +"&peso="+$("#"+$.trim(peso)).val()
//            +"&distancia="+$("#"+$.trim(distancia)).val()
//            +"&estado="+$("#"+$.trim(estado)).val()              
//            +"&vehiculoId="+$("#"+$.trim(vehiculoId)).val(); 
//            var valor= $.ajax({
//                url: "GoVehiculo",
//                type: "POST",
//                data:"opt="+$("#"+$.trim(opt)).val()+goParameter,
//                async: false 
//            }).responseText;        
//            if($.trim(valor)=="1"){
//                accion =true;
//            }else{
//                accion=false;
//            }             
//        return accion;
//   }
//   
//   
