<?php

function fullUpper($string){
  return strtr(strtoupper($string), array(
      "à" => "À",
      "è" => "È",
      "ì" => "Ì",
      "ò" => "Ò",
      "ù" => "Ù",
          "á" => "Á",
      "é" => "É",
      "í" => "Í",
      "ó" => "Ó",
      "ú" => "Ú",
          "â" => "Â",
      "ê" => "Ê",
      "î" => "Î",
      "ô" => "Ô",
      "û" => "Û",
          "ç" => "Ç",
    ));
} 
?>
 <link rel="stylesheet" type="text/css" href="../../recursos/css/style.css"/>
 <table border="0" style="width: 100%;">
    <tbody>
      <?php 
        $filas=0;
        if(count($dataCodigo)>0){
            for($i=0; $i<count($dataCodigo); $i++){
        ?>
      <tr>
          <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo fullUpper($dataCodigo[$i]['nombre']) ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
                <?php $i++ ?>
            </td>    
            
            <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo fullUpper($dataCodigo[$i]['nombre']) ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
                <?php $i++ ?>
            </td>                        
            
            <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo fullUpper($dataCodigo[$i]['nombre']) ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
                <?php $i++ ?>
            </td>                        
            
            <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo fullUpper($dataCodigo[$i]['nombre']) ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
            </td>                        
        </tr>          
        <?php $filas++; } } ?>     
                
    </tbody>
</table>
