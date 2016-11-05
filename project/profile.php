
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<style>
		.wrapper{
        width:400px;
        padding:0px;
        margin:auto;
        margin-top:-100px;
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
		.content{
			margin-left:10px;
		}
		table,td,tr{
			width:800px;
			height:200px;
		}
		img{
			max-width: 200px;
			max-height: 200px;
			height:auto;
			width:auto;
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
$query = $conn -> prepare("select * from profile where user_id = ?");
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
	<form method="post" action="editprofile.php?user_id=<?php echo $data->user_id; ?>" enctype="multipart/form-data">
		<div>
			<p style="font-size:50px;margin-top:140px;text-align:center">Edit Profile</p>
		</div>
		<div class="content">
			<div class="label">
				<label>Name : </label>
				<input type="text" name="first_name" placeholder ="first" style="margin-left:65px;width:95px;padding-top:2.5px;padding-bottom:2.5px;">
				<input type="text" name="last_name" placeholder ="last" style="margin-left:5px;width:95px;padding-top:2.5px;padding-bottom:2.5px;">
			</div>
			<div class="label">
				<label>Birth :</label>
				<input type="date" name="birth" style="margin-left:83px;padding-top:2.5px;padding-bottom:2.5px;">
			</div>
			<div class="label">
				<label>Message : </label>
				<input type="text" name="message" style="margin-left:42px;padding-right:34px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class="label">
				<label>Address : </label>
				<input type="text" name="address" style="margin-left:55px;padding-right:34px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class="label">
				<label>Hobby : </label>
				<input type="text" name="hobby" style="margin-left:63px;padding-right:34px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class="label">
				<label>Education : </label>
				<Select name = "education" style="margin-left:37px;padding-left:10px;padding-right:10px">
					<option value=""></option>
					<option value="smp">SMP</option>
					<option value="sma">SMA</option>
					<option value="s1">S1</option>
					<option value="s2">S2</option>
					<option value="s3">S3</option>
				</Select>
			</div>
			<div class="label">
				<label>Email : </label>
				<input type="text" name="email" style="margin-left:72px;padding-right:34px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class="label">
				<label>Telp : </label>
				<input type="text" name="telp" style="margin-left:83px;padding-right:34px;padding-top:2.5px;padding-bottom:2.5px">
			</div>
			<div class="label">
				<label>Profile Picture : </label>
				<input type="file" name="image" style="margin-left:8px;padding-top:2.5px;padding-bottom:2.5px" placeholder="Upload Image" accept=".jpg,.png,.gif">
			</div>
		</div>

		<div>
			<p style="font-size:45px;margin-top:100px;text-align:center">Choose Your <b style="color:orange;">Talent !</b></p>
		</div>
		<div class="content">
			<div class="talent">
				<table style="margin-left:-170px">
				<tr>
					<td>
						<img src="images/talent/art.png">
						<br>
						<input type="radio" name="talent" value="art" style="margin-left:68px;">
					</td>
					<td>
						<img src="images/talent/cooking.png">
						<br>
						<input type="radio" name="talent" value="cooking" style="margin-left:68px;">
					</td>
					<td>
						<img src="images/talent/dance.png">
						<br>
						<input type="radio" name="talent" value="dance" style="margin-left:68px;">
					</td>
				</tr>
				<tr>
					<td>
						<img src="images/talent/sing.png">
						<br>
						<input type="radio" name="talent" value="sing" style="margin-left:68px;">
					</td>
					<td>
						<img src="images/talent/no.png">
						<br>
						<input type="radio" name="talent" value="no" style="margin-left:68px;">
					</td>
					<td>
						<img src="images/talent/sports.png">
						<br>
						<input type="radio" name="talent" value="sports" style="margin-left:68px;">
					</td>
				</tr>
				</table>
			</div>
			<div class="submit" style="margin-left:15px;"> <input type="submit" value = "update"></div>
			<a href="content.php?user_id=<?php echo $data->user_id ?>" style="margin-left:15px">Cancel</a>
			<div style="margin-top:100px"></div>
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