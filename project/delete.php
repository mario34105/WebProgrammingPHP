<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Account</title>
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
	</style>
</head>
<body>
<?php
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["user_id"])){
		die("<p style='font-size:50px;text-align:center;margin-top:-120px;'>tidak ada <b style='color:orange'>user id !</b></p>");
}
$id = $_GET["user_id"];
$query = $conn -> prepare("select * from user where user_id=?");
$query->bind_param("i",$id);
$result = $query->execute();

if(!$result)
	die("gagal query");

$rows = $query->get_result();
if($rows->num_rows==0){
		echo"<div style='width:300px;margin:auto;margin-top:325px;'>";
        echo"<br>";
        echo"<a href ='login_form.php' style='font-size:20px;bottom:-100px;padding-left:135px;padding-right:135px;'>Back</a></div>";
        echo"<p style='position:fixed;background:black;text-align:center;width:100%;bottom:0px;left:0px;right:0px;margin:auto;color:grey;padding-top:15px;padding-bottom:15px'>&copy;Social 2016</p>";
	die("<p style='font-size:50px;text-align:center;margin-top:-120px;'>User tidak <b style='color:orange'>ditemukan !</b></p>");
}

$query = $conn->prepare("delete from user where user_id=?");
$query->bind_param("i",$id);
$result = $query->execute();

//$produk = $rows -> fetch_object();
//$image = $produk->image;
//if($image != null || file_exists("images/$image")){
	//hapus image
//	unlink("images/$image");


if($result){
    $query = $conn->prepare("select * from profile where profile_id=?");
    $query->bind_param("i",$id);
    $result = $query->execute();
    $rows = $query->get_result();
    $data = $rows->fetch_object();
    $image = $data->image;

    if($image != null || file_exists("images/$image"))
    unlink("images/$image");

    $query = $conn->prepare("delete from profile where profile_id=?");
    $query->bind_param("i",$id);
    $result = $query->execute();
	echo"<p style='font-size:50px;text-align:center;margin-top:250px;'>Data user berhasil <b style='color:orange'>dihapus !</b></p>";
}

else{
	echo"<p style='font-size:50px;text-align:center;margin-top:250px;'>Data user gagal <b style='color:orange'>dihapus !</b></p>";
}
?>
<div style="width:300px;margin:auto;margin-top:-40px">
        <br>
        <a href ="login_form.php#register" style="padding-left:135px;padding-right:135px">Back</a>
    </div>
<div class="footer">
        <div class="footercontent" style="margin:auto;color:grey">
            <p>&copy;Social 2016</p>
        </div>
    </div>
</body>
</html>