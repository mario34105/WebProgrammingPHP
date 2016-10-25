<?php 
session_start();

if(!isset ($_SESSION["username"])){
	die("anda belum login");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contoh Session</title>
</head>
<body>
	<p>Content ini hanya ditampilkan jika user sudah login</p>
	<p><a href="login_form.php">Logout <?php session_destroy(); ?></a></p>
</body>
</html>
