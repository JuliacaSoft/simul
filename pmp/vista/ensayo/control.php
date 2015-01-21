<?php
  if($tipoid=="1"){
  echo "<option value='A'>Área de Conocimiento</option><option value='G'>Grupo de Procesos</option>";
  }elseif($tipoid=="2") {
      $data="";
    foreach($areadep as $item ){
          $data.="<option value='".$item->getArea_id()."'>".$item->getNombre()."</option>";                      
            }        
    echo $data;
   }elseif($tipoid=="3") {
      $data="";
    foreach($grupodep as $item ){
          $data.="<option value='".$item->getGrupo_id()."'>".$item->getNombre()."</option>";                      
            }        
    echo $data;
   }
   
   else{
    
    
}
  
  
 ?>