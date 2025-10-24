<?
session_start();
/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */

$filename = $_SESSION["alumno_ingreso"].'.jpg';
$result = file_put_contents( $filename, file_get_contents('php://input') );
if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/proyecto_estudiantes/fotografias/' . $filename;
print $url;

?>
