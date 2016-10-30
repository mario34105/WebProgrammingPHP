<!DOCTYPE html>
<html>
<head>
	<title>contoh mengupdate data database</title>
</head>
<body>
<?php
require_once"db.php";

// get data yang akan di edit
if(! isset($_GET['user_id']))
	die ("informasi user tidak ditemukan");

$conn=konek_db();

//cari data produk yang akan di update
$id = $_GET["user_id"];
$query = $conn -> prepare("select * from user where user_id = ?");
$query -> bind_param("i" , $id);
$result = $query ->execute();

if (! $result)
	die("gagal query");

$rows = $query->get_result();
if($rows->num_rows ==0)
	die ("<p>Informasi user tidak ditemukan</p>");

$data = $rows->fetch_object();
?>

	<form method="post" action="pass.php?user_id=<?php echo $data->user_id; ?>" enctype="multipart/form-data">
		<div>
			<label>Id</label>
			<p> <?php echo $data->user_id;?></p>
		</div>
		<div>
			<label>Old Password</label>
			<input type="password" name="oldpass">
		</div>
		<div>
			<label>New Password</label>
			<input type="password" name="newpass">
		</div>
		<div>
			<label>Confirmation</label>
			<input type="password" name="confirm">
		</div>
		<div> <input type="submit" value = "update"></div>
</body>
</html>