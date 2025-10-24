<?
session_start();
include_once ("./funciones/conexion.php");
include_once ("./funciones/funciones.php");

if($_POST["ingreso"]){
	$id=$_POST["identificacion"];
	$clave=$_POST["clave"];
	$ingresa=validaUsuario($id,$clave);
	if($ingresa){
		$_SESSION["user_id"]=$id;
		$_SESSION["user_tipo"]=$ingresa["id_tipo_usuario"];
		if($_SESSION["user_tipo"]==1 || $_SESSION["user_tipo"]==2){
			echo "<script>window.location.href='principal_admin.php';</script>";
		}elseif($_SESSION["user_tipo"]==3){
			$_SESSION['esturiante_matriculado']=$id;
			echo "<script>window.location.href='principal_usuario.php';</script>";
		}elseif($_SESSION["user_tipo"]==4){
			echo "<script>FAjax('./usuario/puente_usuario.php','contenido_usuario','','post');</script>";
		}
	}else{
		echo "<script>alert('Usuario o clave incorrectas...');window.location.href='index.php';</script>";	
	}
}else{

if($_POST['puente_usuario']){
	$_SESSION['esturiante_matriculado']=$_POST['alumno_registrado'];
	echo "<script>window.location.href='principal_usuario.php';</script>";
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
<link href="./style_galeria.css" rel="stylesheet" type="text/css" />
<link href="./calendar/calendar-blue.css" rel="stylesheet" type="text/css">
<!--CSS-->
<title>COLEGIO GIMNASIO CERVANTES</title>
<!--HEAD-->

</head>

<body id="cuerpo">
<form id="form" name="form" method="post">
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
													<td align="center" valign="middle" width="99%" height="40"><div id="menu_superior"><? include("./menu_superior.php");?></div></td>
												</tr>
												<tr>
													<td align="center" valign="top">
														<img src="images/spacer.jpg" alt="" width="900" height="4" />
                                                    </td>
												</tr>
												<tr>
													<td align="left" valign="top">
                                                    <div id="contenido_usuario"><? include("noticias.php");?></div>
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
<?
}
?>