<?
session_start();
include_once ("./funciones/conexion.php");
include_once ("./funciones/funciones.php");

if(isset ($_REQUEST['carga_img_noticia'])){

    if($_FILES['imagen']['name']!=''){
		
		echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES['imagen']['name'];
			$tipo = $_FILES['imagen']['type'];
			$tamano = $_FILES['imagen']['size'];
			if($tamano>2000001){
				echo "<script>alert('La imagen es demaciado grande...');window.location.href='principal_admin.php';</script>";
			}else{
				$insert_noticia=setNoticia($_REQUEST["nombre"],$_REQUEST["descripcion"],$_REQUEST["posicion"]);
				//die("******".$insert_noticia."++++++".$nombre);
				   $imagen = $_FILES['imagen']['tmp_name'];
				   $nombre_imagen_asociada = $insert_noticia.".jpg";
				   $directorio="./img/noticias/";
				   $guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);
				if($guardado){
					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";
				}else{
					echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";
				}			
			}
			
    }else{
        //$directorio=$rowtitulo['urlimagen'];
		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_admin.php'</script>";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="./js/ajax.js"></script>
<script type="text/javascript" src="./js/funciones.js"></script>

<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/calendar-es.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<!--CHARSET--> 
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="./css/style_galeria.css" rel="stylesheet" type="text/css" />
<link href="./calendar/calendar-blue.css" rel="stylesheet" type="text/css">
<!--CSS-->
<title>COLEGIO GIMNASIO CERVANTES</title>
<!--HEAD-->

</head>

<body id="cuerpo">
<form id="form" name="form" method="post" enctype="multipart/form-data">
       <table cellpadding="0" cellspacing="0" id="rv_top_adjust_width_0" align="center">
	   		<tr>
				<td align="left" valign="top">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="center" valign="top">
								<!-- START LOGO -->
								<div style="position: absolute;">
								  <div id="Layer1" style="position:relative; left:40px; top:1px; width:180; height:60; text-align:center; z-index:1; overflow:visible; white-space:nowrap;"><img src="images/escudo.gif" width="225" height="225" /></div>
								</div>
								<div style="position: absolute;">
								<div id="Layer2" style="position:relative; left:290px; top:95px; width:auto; height:auto; text-align:left; font-style:italic; z-index:2; overflow:visible; white-space:nowrap;" class="company">COLEGIO <br />GIMNASIO <br />CERVANTES</div>
								</div>
								<div style="position: absolute;">
								  <div id="Layer3" style="position:relative; left:280px; top:35px; width:auto; height:auto; text-align:left; z-index:3; overflow:visible; white-space:nowrap;" class="slogan">"Parte Integral de la <br />Formaci&oacute;n y Desarrollo <br />de Aptitudes y Valores".</div>
								<div style="position: relative;">
								  <div id="Layer4" style="position:relative; left:450px; top:-15px; width:auto; height:auto; text-align:left; z-index:4; overflow:visible; white-space:nowrap;" class="slogan"><iframe src="./header_galery/galeriaNivo.php" frameborder="0" width="532" height="178" scrolling="no" style="border-radius: 0px 90px 0px 90px;"></iframe></div>
								</div></div>
								<!-- END LOGO -->
								<table cellpadding="0" cellspacing="0" width="1000px" align="center">
									<tr> 
										<td align="left" valign="top"><img src="images/img_01.jpg" alt="" width="13px" height="250" /></td>
										<td align="left" valign="top" width="99%" class="bgtop"></td>
										<td align="left" valign="top"><img src="images/img_02.jpg" alt="" width="427px" height="250" /></td>
										<td align="left" valign="top"><img src="images/img_03.jpg" alt="" width="280px" height="250" /></td>
										<td align="left" valign="top"><img src="images/img_04.jpg" alt="" width="280px" height="250" /></td>
								  	</tr>	
								</table>
						  </td>
						</tr>
						<tr>
							<td align="left" valign="top" >
								<table cellpadding="0" cellspacing="0" width="100%" >
									<tr>
										<td align="left" valign="top" class="sideleft"><img src="images/sideleft01.jpg" alt="" width="10" height="296" /></td>
										<td align="left" valign="top" width="99%" rowspan="2">
											<table cellpadding="0" cellspacing="0" width="99%">
												<tr>
													<td align="center" valign="middle" width="99%" height="40"><div id="menu_superior"><? include("./menu_superior_admin.php");?></div></td>
												</tr>
												<tr>
													<td align="center" valign="top">
														<img src="images/spacer.jpg" alt="" width="900" height="4" />
                                                    </td>
												</tr>
												<tr>
													<td align="left" valign="top">
                                                    <div id="contenido">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="210px" valign="top"><div id="menu_left"><? include("menu_left.php");?></div></td>
                                                            <td><div id="area_trabajo"></div></td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                    </td>
												</tr>
											</table>
										</td>
										<td align="left" valign="top" class="sideright"><img src="images/sideright01.jpg" alt="" width="10" height="266" /></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" class="sideleft"><img src="images/sideleft02.jpg" alt="" width="10" height="112" /></td>
										<td align="left" valign="bottom" class="sideright"><img src="images/sideright02.jpg" alt="" width="10" height="142" /></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td align="left" valign="top"><img src="images/bottom_01.jpg" alt="" width="13" height="22" /></td>
										<td align="left" valign="top" width="99%" class="bgbottom"><img src="images/bottom_03.jpg" alt="" width="328" height="22" /></td>
										<td align="left" valign="top"><img src="images/bottom_02.jpg" alt="" width="659" height="22" /></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
            <tr>
              <td>
                  <div id="footer">
                      <? include("pie.php");?>
                  </div>	
              </td>
            </tr>
  		</table>
</form>
</body>
</html>
