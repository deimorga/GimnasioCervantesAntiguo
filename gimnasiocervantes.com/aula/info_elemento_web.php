<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

?>
        <table width="700px" cellspacing=0 border="0">
			<tr>
				<td colspan="2" align="center" class="subenlace" valign="top">
				<h2>Elementos De La Web.</h2>
                </td>
			</tr>
			<tr>
            	<td>Tipo De Elemento:</td>
				<td valign="top">
                <select name="tipo_e" id="tipo_e" onchange="FAjax('./aula/form_elemento_web.php','div_elemento','','post');" class="champ2">
                	<option value="">Seleccione...</option>
<?
$tipo=getTipoElemento1();
for($i=0;$i<count($tipo);$i++){
?>
                    <option value="<?=$tipo[$i]['id_tipo_elemento']?>" ><?=$tipo[$i]['nombre_tipo_elemento']?></option>
<?
}
?>
                </select>
                </td>
			</tr>
            <tr>
				<td colspan="2" valign="top"><div id="div_elemento"></div></td>
			</tr>


			<tr>
				<td align="right" colspan="2" class="subenlace" valign="top"><div id="div_list_elemento">
				<?
                include_once("listado_elementos_web.php");
				?>
                </div>                
                </td>
			</tr>


        </table>