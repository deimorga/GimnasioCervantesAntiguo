<?
session_start();
//require("conexion.php");

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&apos;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

$centro="COLEGIO GIMNASIO CERVANTES";
$coordenadas="Cll 9 No. 6-71 Facatativá        Telefax: 8430744        Email: colegiogimnasiocervantes@hotmail.com";

// Select all the rows in the markers table
//$query = "SELECT * FROM tbl_centro WHERE id_centro=$id";
//$result = mysql_query($query);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($centro) . '" ';
  echo 'address="' . parseToXML($coordenadas) . '" ';
  echo 'lat="4.815838" ';
  echo 'lng="-74.354199" ';
  echo 'type="2" ';
  echo '/>';

// End XML file
echo '</markers>';
?>