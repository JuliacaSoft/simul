<?php
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";
require_once "../modelo/PreguntaDAO.php";

include 'excel_reader.php';     // include the class


?>

<?php
require("upload.php");

$status = "";

$estadoImport="";
if (!Empty ($_POST["action"])){
if ($_POST["action"] == "upload") {
	$fupload = new Upload();
	$fupload->setPath("files");
	$fupload->setFile("archivo");
	$fupload->isImage(true);
	$fupload->save();
	
	$status = $fupload->message;
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>PHP upload - unijimpe</title>
<script type="text/javascript" src="../../recursos/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
<link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
<link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/>  
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>
  
  <div class="myformBusqueda" id="stylizedBusqueda">  
  <table width="413" border="0" cellspacing="0" cellpadding="0">

  <tr>
      <td class="text"><h1>Por favor ñandú seleccione el archivo a subir:</h1></td>
  </tr>
  
  
  <tr>
  <td class="text">
    <form action="index.php" method="post" enctype="multipart/form-data" target="content">    
      <input name="archivo" type="file" class="casilla" id="archivo" size="35" />
      
      <button name="enviar" class="boton" id="enviar"  type="submit">Subir Archivo</button>
      <input name="action" type="hidden" value="upload" />
      <button type="button" onclick="location.href='index.php?action=importar'">Importar</button>        
    </form>

  </td>
  </tr>
  
  
  
  <tr>
      <td class="text" style="color: #ffffff"><?php echo $status; ?></td>
  </tr>

  <tr>
    <td class="infsub">
<?php

// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read("testpmi.xls");

function sheetData($sheet) {
  $re = '<table id="table" class="formTable">';     // starts html table

  $x = 1;
  $xx=1;
  while($x <= $sheet['numRows']) {
    $re .= "<tr>\n";
    $y = 1;
    while($y <= $sheet['numCols']) {
      
      if($x==1){ 
            $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';     
            if($y==1){$re .= " <th>#</th>\n<th>$cell</th>\n";  }else{ $re .= " <th>$cell</th>\n"; }  
       }else{
            $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';     
            if($y==1){$re .= " <td>$xx</td>\n<td>$cell</td>\n";  }else{ $re .= " <td>$cell</td>\n"; }            
       } 
      $y++;
    } 
    $re .= "</tr>\n";
    if($x>1){$xx++;}
    $x++;
    
  }
  


 return $re .'</table>';     // ends and returns the html table
}




if (!Empty ($_REQUEST["action"])){
    if ($_REQUEST["action"] == "importar") {
    $nr_sheetsX = count($excel->sheets);
    $msg=0;
        for($i=0; $i<$nr_sheetsX; $i++) {
          $dao=new PreguntaDAO();
        $msg=$dao->sheetData($excel->sheets[$i]);
        }
        $estadoImport="Se registro correctamente ".$msg." preguntas!";
        if($msg>=1){
        $myFile = "testpmi.xls";
        unlink($myFile);
        }
    }
}


$excel_data = '';
if (file_exists("testpmi.xls")) {

$nr_sheets = count($excel->sheets);       // gets the number of sheets
              // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$nr_sheets; $i++) {
  $excel_data .= sheetData($excel->sheets[$i]) .'<br/>';
}
}
?>        

    </td>
  </tr>
</table>
  </div> 
<div>
<?php
if (file_exists("testpmi.xls")==false) {
    echo $estadoImport;
}else{
  echo $excel_data;  
}

?>        
</div>    
</body>
</html>
