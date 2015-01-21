<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <link rel="stylesheet" type="text/css" href="../../recursos/css/style.css"/>
 <table border="0" style="width: 100%">
    <tbody>
      <?php 
        if(count($dataCodigo)>0){
            for($i=0; $i<count($dataCodigo); $i++){
        ?>
      <tr>
          <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo $dataCodigo[$i]['nombre'] ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
                <?php $i++ ?>
            </td>    
            
            <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo $dataCodigo[$i]['nombre'] ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
                <?php $i++ ?>
            </td>                        
            
            <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo $dataCodigo[$i]['nombre'] ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
                <?php $i++ ?>
            </td>                        
            
            <td style="width: 25%">          
      
                <div class="tiketx">
                  <?php echo $dataCodigo[$i]['nombre'] ?><br/>  
                  <img  src="test.php?texto=<?php echo $dataCodigo[$i]['codigo'] ?>" alt="Barcode Image" />    
                </div> 
                <p>                    
                </p>      
            </td>                        
        </tr>          
        <?php } } ?>     
                
    </tbody>
</table>
