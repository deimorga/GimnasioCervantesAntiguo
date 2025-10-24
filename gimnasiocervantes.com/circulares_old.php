<?
function orden($a,$b){ 
global $carpeta;
$directorio='directorio/'; 
return strcmp(strtolower($b), strtolower($a));
}
$carpeta='./circulares/'; 
$carpeta=opendir($carpeta);
while($archivos=readdir($carpeta)){
	if (eregi("pdf", $archivos) ){
$archivo[]=$archivos; 
usort($archivo, "orden"); 
	}
}
?>
<h2>Listado de circulares.</h2>
<?
foreach($archivo as $archiv){
echo '&nbsp;&nbsp;&nbsp;&nbsp;&rArr;&nbsp;&nbsp;<a href="./circulares/'.$archiv.'" target="_blank">'.$archiv.'</a><br>';
}
closedir($carpeta); 
?>