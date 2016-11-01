<?php 
session_start();

require_once"db.php";

if(!isset ($_SESSION["username"])){
	die("anda belum login");
}

$conn=konek_db();
$id = ($_GET["user_id"]);
$query = $conn -> prepare("select * from profile where profile_id = ?");
$query -> bind_param("i" , $id);
$result = $query ->execute();
$rows = $query->get_result();
$data = $rows->fetch_object();

?>
<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<style>
	.wrapper{
        width:50%;
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
            font-size:15px;
            padding-top:5px;padding-bottom:5px;padding-left:25px;padding-right:25px;
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
		.option{
			float:right;
		}
		.image{
			width:30%;
		}
		.image img{
			max-height: 200px;
			max-width: 200px;
			height:auto;
			width:auto;
		}
		.name{
			width:60%;
			margin-left:270px;
			margin-top:-230px;
		}
		.edit a{
			background:none;
			border: 1px solid white;
			padding-left:50px;
			padding-right:50px;
			font-size:25px;
			border-radius:10px;
		}
		.about{
			margin-top:100px;
		}
		.info{
			width:400px;
			margin:auto;
			padding-bottom:100px;
		}
	</style>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<p style="width:30%">Welcome, <b style="color:orange"><?php echo $_SESSION["username"] ?></b> </p>
		<div class="option" style="margin-top:-35px">
			<a href="edit.php?user_id=<?php echo $data->user_id; ?>">Change Password</a>
			<a href="logout.php">Logout</a>
			<a href="delete.php?user_id=<?php echo $data->user_id;?>">Delete Acc</a>
		</div>
	</div>
	<div class="content" style="margin-top:100px">
		<div class="titlename">
			<div class="image">
				<?php
					if( $data->image == null || $data->image == "")
						$url_image="images/no.png";
					else
						$url_image="images/$data->image";
					?>
				
					<img src = '<?php echo $url_image ?>'>
			</div>
			<div class="name">
				<p style="font-size:60px;text-align:center"><?php echo $data->first_name;?> <?php echo $data->last_name;?></p>
				<hr style="border-color:orange;margin-top:-50px">
				<p style="text-align:center;font-size:30px;margin-top:-1px"><?php echo $data->message;?></p>
			</div>
		</div>

		<div class="edit" style="margin:auto;margin-top:70px;margin-left:230px">
			<a href="profile.php?user_id=<?php echo $data->user_id;?>">Edit Profile</a>
		</div>
		<div class="about">
		<p style="font-size:50px;text-align:center">About <?php echo $data->first_name;?></p>
		<hr style="border-color:orange;margin-top:-50px;width:60%">
			<div class="info">
				<p style="font-size:30px">Birth Date : <?php echo $data->birth?></p>
				<p style="font-size:30px">Address : <?php echo $data->address?></p>
				<p style="font-size:30px">Hobby : <?php echo $data->hobby?></p>
				<p style="font-size:30px">Education : <?php echo $data->education?></p>
				<p style="font-size:30px">Email : <?php echo $data->email?></p>
				<p style="font-size:30px">Telp : <?php echo $data->telp?></p>
			</div>
		</div>
	</div>
</div>
	<div class="footer">
		<div class="footercontent" style="margin:auto;color:grey">
			<p>&copy;Social 2016</p>
		</div>
	</div>
</div>
</body>
</html>
