<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
<?php
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["user_id"]))
	die("tidak ada id user");

$id = $_GET["user_id"];
$query = $conn -> prepare("select * from user where user_id=?");
$query->bind_param("i",$id);
$result = $query->execute();


if(!$result)
	die("gagal query");
$rows = $query->get_result();
$row = $rows->fetch_array();
if($rows->num_rows==0)
	die("user tidak ditemukan");
if(! isset($_POST["oldpass"]) ||
   ! isset($_POST["newpass"]) ||
   ! isset($_POST["confirm"]))
	die("data password tidak lengkap");

if(md5($_POST["oldpass"]) == $row['password']){
 if($_POST["newpass"] == $_POST["confirm"])
    {
        $password  = md5($_POST["newpass"]);    
    }
    else{
        die("<p>password tidak cocok dengan confirm</p>");
    }
}



$query = $conn->prepare("update user set password=?  where user_id=?");
$query->bind_param("ss",$password,$id);
$result = $query->execute();

if($result)
	echo"<p>Data produk berhasil di update</p>";
else
	echo"<p>Gagal mengupdate data produk</p>";
?>
</body>
</html>