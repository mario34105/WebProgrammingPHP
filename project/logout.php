<?php 
session_start();
session_destroy();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Log out</title>
 </head>
 <body>
 	<?php header("location: login_form.php"); ?>
 </body>
 </html>