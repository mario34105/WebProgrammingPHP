<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<style>
		.wrapper{
        width:400px;
        padding:0px;
        margin:auto;
        }

        body{
            font-family:Alcubierre;
            color:white;
            background : linear-gradient(0deg, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0.7) 100%), url(images/cover.jpg) 0 0 ;
            background-size:cover;
        }

        a{
            font-family:Alcubierre;
            font-weight:bold;
            background:orange;
            color:white;
            border-radius:5px;
            font-size:20px;
            padding-top:5px;padding-bottom:5px;padding-left:127px;padding-right:128px;
            border:none;
            text-decoration:none;

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
			margin-bottom:20px;
		}
		.label {
			font-size:20px;
			margin-top:10px;
		}
	</style>
</head>
<body>
<?php
require_once"db.php";

// get data yang akan di edit
if(! isset($_GET['user_id']))
	die ("<p style='font-size:50px;text-align:center;margin-top:-125px;'>Informasi user tidak <b style='color:orange'>ditemukan !</b></p>");

$conn=konek_db();

//cari data produk yang akan di update
$id = $_GET["user_id"];
$query = $conn -> prepare("select * from user where user_id = ?");
$query -> bind_param("i" , $id);
$result = $query ->execute();

if (! $result)
	die("gagal query");

$rows = $query->get_result();
if($rows->num_rows == 0)
	die ("<p style='font-size:50px;text-align:center;margin-top:-125px;'>Informasi user tidak <b style='color:orange'>ditemukan !</b></p>");

$data = $rows->fetch_object();
?>
	<div class="wrapper">
	<form method="post" action="pass.php?user_id=<?php echo $data->user_id; ?>" enctype="multipart/form-data">
		<div>
			<p style="font-size:50px;margin-top:140px">Change Password</p>
		</div>
		<div class="content" style="margin-left:10px">
		<div class="label">
			<label>Old Password : </label>
			<input type="password" name="oldpass" style="margin-left:12px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
		</div>
		<div class="label">
			<label>New Password : </label>
			<input type="password" name="newpass" style="margin-left:2px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
		</div>
		<div class="label">
			<label>Confirmation : </label>
			<input type="password" name="confirm" style="margin-left:12px;padding-right:33px;padding-top:2.5px;padding-bottom:2.5px">
		</div>
		<div class="submit" style="margin-left:15px"> <input type="submit" value = "update"></div>
		<a href="content.php?user_id=<?php echo $data->user_id ?>" style="margin-left:15px">Cancel</a>
		</div>
	</form>
	<div class="footer">
		<div class="footercontent" style="margin:auto;color:grey">
			<p>&copy;Social 2016</p>
		</div>
	</div>
	</div>
</body>
</html>