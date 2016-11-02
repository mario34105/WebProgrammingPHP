<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Social</title>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>

	<style>

		html{
			overflow:hidden;
		}
		body{
			font-family:Alcubierre;
			color:white;
			background : linear-gradient(0deg, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0.7) 100%), url(images/cover.jpg) 0 0 ;
			background-size:cover;
		}
		.wrapper{
		width: 50%;
		padding:0px;
		margin:auto;
		}
		.login{
			width:400px;
			margin:auto;
			padding-top:20px;
		}
		.register{
			width:400px;
			margin:auto;
			margin-top:200px;
			height:800px;
		}
		.entry{
			margin:auto;
			font-size:20px;
			margin-left:40px;
		}

		.footer{
		position:fixed;
		background:black;
		text-align:center;
		width:100%;
		bottom:0px;
		left:0px;
		right:0px;
		}

		a{
			font-family:Alcubierre;
			font-weight:bold;
			background:orange;
			color:white;
			border-radius:5px;
			font-size:20px;
			padding-top:5px;padding-bottom:5px;padding-left:123px;padding-right:122px;
			border:none;
			text-decoration:none;
		}
		
		.submit input{
			font-family:Alcubierre;
			font-weight:bold;
			background:orange;
			color:white;
			border-radius:5px;
			font-size:20px;
			width:312px;
			margin-top:20px;
			padding-top:5px;padding-bottom:5px;
			border:none;
		}


	</style>
</head>
<body>
<?php
require_once("db.php");
//jika sudah login ; dan belum logout, redirect ke content
if(isset($_SESSION["username"]))
	header("location: content.php");

//jika belum login, dan belum ada kirim username dan password
//tampilkan form login
if (!isset($_POST["username"]) ||
	!isset($_POST["password"])) {
?>
<div class="wrapper" id="login">

	<div class="login" >
		<form method="post" action="login_form.php">
	<div class="title" style="text-align:center;">
		<h1 style="color:white;font-size:100px;">Social</h1>
		<hr style="margin-top:-30px">
		<p style="font-weight:bold;font-size:30px">Know each other with <b style="color:#fcb30a;font-size:40px">Social</b></p>
	</div> 
		<div class="entry">
			<div>
				<label style="font-weight:bold;">Username :</label>
				<input type="text" name="username" style="padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div style="margin-top:10px;">
				<label style="font-weight:bold;">Password   :</label>
				<input type="password" name="password" style="margin-left:12px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class="submit">
				<input type="submit" value="Login">
			</div>
			<div style="margin-top:-10px;">
			<br>
				<a href="#register">Register</a>
			</div>
			
		</div>
		</form>

		<div class="register" id="register" style="padding-top:5px">
		<form method="post" action="register.php" enctype="multipart/form-data" style="margin-top:-40px">
	<div class="title" style="text-align:center;">
		<h1 style="color:white;font-size:100px;">Social</h1>
		<hr style="margin-top:-60px">
		<p style="font-weight:bold;font-size:30px;"><b style="color:#fcb30a;font-size:40px">Register</b> Your Account</p>
	</div> 
		<div class="entry" style="margin-top:-20px">
			<div>
				<label style="font-weight:bold;">name :</label>
				<input type="text" name="first_name" placeholder ="first" style="margin-left:5px;margin-left:36px;width:95px;padding-top:2.5px;padding-bottom:2.5px">
				<input type="text" name="last_name" placeholder ="last" style="margin-left:5px;width:95px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div style="margin-top:10px">
				<label style="font-weight:bold;">gender :</label>
				<input type="radio" name="gender" value="male" style="margin-left:27px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">Male
				<input type="radio" name="gender" value="female" style="margin-left:27px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">Female
			</div>
			<div style="margin-top:10px;">
				<label style="font-weight:bold;">Username :</label>
				<input type="text" name="username" style="padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div style="margin-top:10px;">
				<label style="font-weight:bold;">Password   :</label>
				<input type="password" name="password" style="margin-left:12px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div style="margin-top:10px">
				<label style="font-weight:bold;">Confirm : </label>
				<input type="password" name="confirm" style="margin-left:20px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class ="submit">
				<input type="submit" value="Sign Up">
			</div>
			<div style="margin-top:-10px;">
			<br>
				<a href ="#login" style="padding-left:135px;padding-right:135px">Back</a>
			</div>
		</div>
		</form>
	</div>
	
<?php
//jika belum login, dan sudah kirim username dan password
// cek apakah username dan password valid
} else{
	$username = $_POST["username"];
	$password = $_POST["password"];
//cek username dan password valid , jika valid loginkan user dan 
//redirect ke content
	$conn = konek_db();
	$query = $conn->prepare("select *  from user where username ='$username'");

	$result = $query->execute();
	$rows = $query -> get_result();
	$row = $rows->fetch_array();

	if(!empty($row['username']))
	{
		if(md5($password) == $row['password']){
		$_SESSION['username'] = $row['password'];
		//login user
		$_SESSION["username"] = $username;
		//redirect ke content
		header("location: content.php?user_id=".$row['user_id']);
	}
	else{
		echo "<p style='font-size:50px;text-align:center;margin-top:250px;'>Username/Password <b style='color:orange'>Salah</b></p>";
		echo  "<a href ='login_form.php' style='padding-left:135px;padding-right:135px;margin-left:520px'>Back</a>";
		//jika username/paswword salah ditampilkan warning
	}
	} else {
		echo "<p style='font-size:50px;text-align:center;margin-top:250px;'>Username/Password <b style='color:orange'>Salah</b></p>";
		echo  "<a href ='login_form.php' style='padding-left:135px;padding-right:135px;margin-left:520px'>Back</a>";
	}	
}
?>
	</div>
	<div class="footer">
		<div class="footercontent" style="margin:auto;color:grey">
			<p>&copy;Social 2016</p>
		</div>
	</div>
</div>
</body>
</html>