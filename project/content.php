<?php 
session_start();

require_once"db.php";

if(!isset ($_SESSION["username"])){
	die("anda belum login");
}

$conn=konek_db();

$id = $_SESSION["username"];
$query = $conn -> prepare("select *
FROM user
LEFT JOIN profile
ON user.user_id=profile.profile_id where user.username = ?");
$query -> bind_param("s" , $id);
$result = $query ->execute();
$rows = $query->get_result();
$data = $rows->fetch_object();


$id1 = $_GET["user_id"];
$query1 = $conn -> prepare("select * from profile where user_id = ?");
$query1 -> bind_param("i" , $id1);
$result1 = $query1 ->execute();
$rows1 = $query1->get_result();
$data1 = $rows1->fetch_object();

$query2 = $conn -> prepare("select * from talent where user_id = ?");
$query2 -> bind_param("i", $id1);
$result2 = $query2->execute();
$rows2 = $query2->get_result();
$data2 = $rows2->fetch_object();

if ($data1->first_name == null){
  header("location:profile.php?user_id=$id1");
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<style>
	.wrapper{
        width:700px;
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
		.friends a{
			background:none;
			border: 1px solid white;
			padding-left:50px;
			padding-right:50px;
			font-size:25px;
			border-radius:10px;
		}
		.about{
			margin-top:80px;
		}
		.info{
			width:400px;
			margin:auto;
			padding-bottom:100px;
		}
		.talent{
			margin-top:100px;
		}
		.talent img{
			margin-top:60px;
			max-height: 200px;
			max-width: 200px;
			height:auto;
			width:auto;
		}
	</style>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<p style="width:30%">Welcome, <a href="content.php?user_id=<?php echo$data->user_id;?>" style="background:none;padding:0"><b style="color:orange"><?php echo $_SESSION["username"] ?></b></a> </p>
		<div class="option" style="margin-top:-35px">
			<a href="edit.php?user_id=<?php echo $data->user_id; ?>">Change Password</a>
			<a href="profile.php?user_id=<?php echo $data->user_id;?>">Edit Profile</a>
			<a href="logout.php">Logout</a>
			<a href="delete.php?user_id=<?php echo $data->user_id;?>">Delete Acc</a>
		</div>
	</div>
	<div class="content" style="margin-top:100px">
		<div class="titlename">
			<div class="image">
				<?php
					if( $data1->image == null || $data1->image == "")
						$url_image="images/no.png";
					else
						$url_image="images/$data1->profile_id - $data1->first_name/$data1->image";
					?>
				
					<img src = '<?php echo $url_image ?>'>
			</div>
			<div class="name">
				<p style="font-size:60px;text-align:center"><?php echo $data1->first_name;?> <?php echo $data1->last_name;?></p>
				<hr style="border-color:orange;margin-top:-50px">
				<p style="text-align:center;font-size:30px;margin-top:-1px"><?php echo $data1->message;?></p>
			</div>
		</div>

		<div class="friends" style="margin:auto;margin-top:70px;margin-left:235px">
			<a href="friends.php?user_id=<?php echo $data->user_id?>">Find Friends</a>
		</div>

		<div class="talent">
		<p style="font-size:50px;text-align:center"><?php echo $data1->first_name;?>'s Talent</p>
		<hr style="border-color:orange;margin-top:-50px;width:60%">
		<img src="images/talent/<?php echo $data2->talent_name?>.png" style="margin-left:270px">
		</div>

		<div class="about">
		<p style="font-size:50px;text-align:center">About <?php echo $data1->first_name;?></p>
		<hr style="border-color:orange;margin-top:-50px;width:60%">
			<div class="info">
				<p style="font-size:30px">Birth Date : <?php echo $data1->birth?></p>
				<p style="font-size:30px">Gender : <?php echo $data->gender?></p>
				<p style="font-size:30px">Address : <?php echo $data1->address?></p>
				<p style="font-size:30px">Hobby : <?php echo $data1->hobby?></p>
				<p style="font-size:30px">Education : <?php echo $data1->education?></p>
				<p style="font-size:30px">Email : <?php echo $data1->email?></p>
				<p style="font-size:30px">Telp : <?php echo $data1->telp?></p>
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
