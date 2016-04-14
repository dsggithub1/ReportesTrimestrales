<!DOCTYPE html>

<?php


$archivo=$_REQUEST['archivo'];
 
 $trimestre=substr($archivo,2,1);
 

 $anio=substr($archivo,0,2);
 
 
 $pestana=0;
 
 if( strpos($archivo, "ingresos"))
  $pestana=1;
else if( strpos($archivo, "ebitda"))
  $pestana=2;
else if( strpos($archivo, "utilidad"))
  $pestana=3;
  

  
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Monitor de Reportes Trimestrales</title>
<meta name="robots" content="index, follow" />
<meta name="keywords" content="Sector Energético, Mapa económico de México, Mapa interactivo, BMV, Bolsa Mexicana de Valores, Macroeconomía, Microeconomía, Bolsas, Educación financiera, Finanzas Personales, Elfinanciero, El Financiero, Economía mexicana, Inflación, Crecimiento, PIB, Tasas, Fondos, Afores, Inversión, Ciclo económico" />
<meta name="Author" content="El Financiero" />
<meta name="description" content="" />
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script src="js/selectivizr-min.js"></script>
<script src="js/modernizr.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- GMD -->
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.blue_grey-indigo.min.css">
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.4/material.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- /GMD -->
</head>

<body>
  <div class="container">
  <header class="">
    <div id="Portada"><h1>Monitor de Reportes Trimestrales</h1></div>
    
    <button id="demo-menu-lower-left" class="mdl-button mdl-js-button mdl-button--icon" data-upgraded=",MaterialButton">
      <i class="material-icons">share</i>
    </button>
    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
        for="demo-menu-lower-left">
      <li class="mdl-menu__item"><a href="http://www.facebook.com/share.php?u=http://graficos.elfinanciero.com.mx/2015/volver-al-futuro/grafica/index.html" onClick="window.open(this.href, this.target, 'width=500,height=400, scrollbars=1'); return false;"><img src="img/facebook.svg" height="16" alt="">Facebook</a></li>
      <li class="mdl-menu__item"><a href="http://twitter.com/home?status=http://graficos.elfinanciero.com.mx/2015/volver-al-futuro/grafica/index.html" onClick="window.open(this.href, this.target, 'width=500,height=400, scrollbars=1'); return false;"><img src="img/twitter.svg" height="16" alt="">Twitter</a></li>
      <li class="mdl-menu__item"><a href="https://plus.google.com/share?url=http://graficos.elfinanciero.com.mx/2015/volver-al-futuro/grafica/index.html" onClick="window.open(this.href, this.target, 'width=500,height=400, scrollbars=1'); return false;"><img src="img/plus.svg" height="14" alt="">Google +</a></li>
    </ul>

   <nav>
      <ul id="TipoIndicador">
        <li class="col-xs-4"><a id="Ingresos" href="csv.php?archivo=<?php echo $anio.$trimestre;?>tingresos.csv" class="<?php
    if(1 == $pestana)
    echo "Active";
    ?>">Ingresos</a></li>
        <li class="col-xs-4"><a id="EBITDA" href="csv.php?archivo=<?php echo $anio.$trimestre;?>tebitda.csv" class="<?php
    if(2 == $pestana)
    echo "Active";
    ?>">EBITDA</a></li>
        <li class="col-xs-4"><a id="Utilidad" href="csv.php?archivo=<?php echo $anio.$trimestre;?>tutilidad.csv" class="<?php
    if(3 == $pestana)
    echo "Active";
    ?>">Utilidad</a></li>
      </ul>
      <select name="Trimestre" id="Trimestre" onchange="location = this.options[this.selectedIndex].value;">
        <option value="csv.php?archivo=154tingresos.csv" <?php 
      if($trimestre==4)
        echo "selected";
        
    ?>>4TO. TRIMESTRE 2015</option>
        <option value="csv.php?archivo=153tingresos.csv" <?php 
      if($trimestre==3)
        echo "selected";
        
    ?>>3ER. TRIMESTRE 2015</option>
        <option value="csv.php?archivo=152tingresos.csv" <?php 
      if($trimestre==2)
        echo "selected";
        
    ?>>2DO. TRIMESTRE 2015</option>
        <option value="csv.php?archivo=151tingresos.csv" <?php 
      if($trimestre==1)
        echo "selected";
        
    ?> >1ER. TRIMESTRE 2015</option>
      </select>
    </nav>
  </header>
<?php


jj_readcsv($archivo,true);

function jj_readcsv($filename, $header=false) {
$handle = fopen($filename, "r");
echo "<table id='Ingresos' class='Indicadores'>";
//display header row if true
if ($header) {
    $csvcontents = fgetcsv($handle);
    echo "<tr class='TableHead'>";
  $i=0;
    foreach ($csvcontents as $headercolumn) {
    if($i!=1)
    {
      if($i==2)
        echo "<th class='AlignRight BorderRight hidden-xs'>$headercolumn</th>";
      else if($i==5)
        echo "<th class='AlignRight BorderRight'>$headercolumn</th>";
      else if($i==6)
        echo "<th class='hidden-xs'>$headercolumn</th>";
      else if($i==7)
        echo "<th class='AlignRight hidden-xs'>$headercolumn</th>";
      else
        echo "<th>$headercolumn</th>";
    }
    $i++;
    if($i>=8)
      break;
    }
    echo '</tr>';
}
// displaying contents
$v=0;
$tabla=1;
$t=0;
$automata ="";
$footer ="";
while ($csvcontents = fgetcsv($handle)) {
   
  $i=0;
  
  if($v>=1 && $tabla==1)
  {
   echo '<tr>';
  $lineaA = "";
  $lineaB1 = "";
  $lineaB2 = "";
  $lineaB3 = "";
  $lineaC = "";
    foreach ($csvcontents as $column) {
    if($i==0 )
    {
      if(strlen($column)==0)
      {
        echo '</table>';
        $tabla=2;
        break;
      }
      else
      $lineaA = "<td class='Compania'><a href='#' class='visible-xs'>$column</a>";
    }
    else if($i==1)
      $lineaA = $lineaA . "<a href='#' class='hidden-xs'>$column</a></td>";
    else if($i==2)
      $lineaB1 = "<td class='Fecha hidden-xs'>$column</td>";
    else if($i==3)
      $lineaC = "<td class='ResultadoActual'>$column</td>";
    else if($i==4)
      $lineaC = $lineaC . "<td class='ExpectativaActual'>$column</td>";
    else if($i==5)
      {
        $l_signo=signo($column);
        $lineaC = $lineaC . "<td class='VarActual $l_signo'>$column</td>";
      }
    else if($i==6)
      $lineaC = $lineaC . "<td class='ResultadoAnterior hidden-xs'>$column</td>";
    else if($i==7)
      {
        $l_signo=signo($column);
        $lineaC = $lineaC . "<td class='VarAnual $l_signo hidden-xs'>$column</td>";
      }
    else if($i==12)
      {
        
        $lineaB2 =  "$column";
      }
    else if($i==13)
      {
        
        $lineaB3 =  "$column";
      }
      
    /*else
      echo "<td>$column</td>";*/
    
    $i++;
    
    /*if($i>=8)
      break;*/
      
     
    }
  if(strlen($lineaB2)>0 && strlen($lineaB3)>0)
      echo $lineaA . "<td class='Fecha hidden-xs'><a target='_blank' href='$lineaB2'>Nota</a>". "<a target='_blank' href='$lineaB3'>Reporte</a></td>" . $lineaC;
    else if(strlen($lineaB2)>0)
      echo $lineaA . "<td class='Fecha hidden-xs'><a target='_blank' href='$lineaB2'>Nota</a>". $lineaC;
    else if(strlen($lineaB3)>0)
      echo $lineaA . "<td class='Fecha hidden-xs'><a target='_blank' href='$lineaB3'>Reporte</a>". $lineaC;
    else
      echo $lineaA . $lineaB1 . $lineaC;
  echo '</tr>';  
  }
  else if($tabla==2)
  {
  $i=0;
  
  $linA = "";
  $linB1 = "";
  $linB2 = "";
  $linB3 = "";
  $linC = "";
  
  $t++;
  foreach ($csvcontents as $column)
  {
    if($i==0 && $column=='titulo')
    {
      $automata ="titulo";
      
    }
    else if($i==0 && $column=='desctitulo')
    {
      $automata ="desctitulo";
      
    }
    else if($i==0 && $column=='nuevatabla')
    {
      $automata ="nuevatabla";
      $t=0;
      echo "<br>";
      echo "<table id='Ingresos' class='Indicadores'><tbody><tr class='TableHead'>";
    }
    else if($i==0 && $automata=='nuevatabla' && strlen($column)==0)
    {
      $automata ="finnuevatabla";
      
    }
    
    
    if($automata=="titulo" && $i==1)
    {
      echo "<div id='GposFinancieros'><h4>".$column."</h4>";
    }
    else if($automata=="desctitulo" && $i==1)
    {
      echo "<div class='Anotacion'>".$column."</div></div>";
    }
    else if($automata=="nuevatabla")
    {
      if($t==1)
      {
        if($i==0 || ($i>=2 && $i<=3) || $i==6 || $i==7)
        {
          if($i==2)
            echo "<th class='AlignRight BorderRight hidden-xs'>$column</th>";
          else if($i==7)
            echo "<th class='AlignRight'>$column</th>";
          else
            echo "<th>$column</th>";
        }
        
      }
      else if($t>1)
      {
        if(($i>=0 && $i<=3) || $i==6 || $i==7 || $i==12 || $i==13)
        {
          if($i==0)   
            $linA= "<td class='Compania'><a href='#' class='hidden-xs'>$column</a>";
          else if($i==1)   
            $linA = $linA . "<a href='#' class='visible-xs'>$column</a></td>";
          else if($i==2)
            $linB1 = "<td class='Fecha hidden-xs'>$column</td>";
          else if($i==3)
            $linC =  "<td class='ResultadoActual'>$column</td>";
          else if($i==6)
            $linC = $linC . "<td class='ResultadoAnterior'>$column</td>";
          else if($i==7)
          {
            $l_signo=signo($column);
            $linC = $linC .  "<td class='VarAnual $l_signo'>$column</td>";
          }
          else if($i==12)
          {
            
            $linB2 =  "$column";
          }
          else if($i==13)
          {
            
            $linB3 =  "$column";
            
            
          }
        
        }
        
      }
    }
    else if($automata=='finnuevatabla')
    {
      //echo "$footer";
      if($i==0)
      $footer= $footer."$column" . "<br>";
    
    }
    
    
  $i++;
    
  }
    if($t>0)
      $linC = $linC . "</tr>";
    
  
  
    if(strlen($linB2)>0 && strlen($linB3)>0)
      echo $linA . "<td class='Fecha hidden-xs'><a target='_blank' href='$linB2'>Nota</a>". "<a target='_blank' href='$linB3'>Reporte</a></td>" . $linC;
    else if(strlen($linB2)>0)
      echo $linA . "<td class='Fecha hidden-xs'><a target='_blank' href='$linB2'>Nota</a>". $linC;
    else if(strlen($linB3)>0)
      echo $linA . "<td class='Fecha hidden-xs'><a target='_blank' href='$linB3'>Reporte</a>". $linC;
    else
      echo $linA . $linB1 . $linC;
  
  } //fin tabla2
  
  
  $v++;
     
} //end while
echo '</table>';

echo "<div id='Fuente'>".$footer. "</div>";

fclose($handle);
}

function signo($p_valor)
{

if($p_valor<0)
  return "Negativo";
else  
  return "Positivo";
}

?>

</div><!-- / .container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script_graficas.js"></script>
</body>
</html>
