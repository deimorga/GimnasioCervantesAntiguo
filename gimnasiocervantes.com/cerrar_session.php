<?
session_start();
session_destroy();
session_start();
?>
<script>
alert('Su session fue cerrada!');
window.location.href='./index.php';
</script>