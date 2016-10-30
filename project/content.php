<?php 
session_start();

require_once"db.php";

if(!isset ($_SESSION["username"])){
	die("anda belum login");
}

$conn=konek_db();
$id = ($_GET["user_id"]);
$query = $conn -> prepare("select * from user where user_id = ?");
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
	<div class="content">
		
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
