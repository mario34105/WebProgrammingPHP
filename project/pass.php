<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
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
            font-size:20px;
            padding-top:5px;padding-bottom:5px;
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

<div class="footer">
    <div class="footercontent" style="margin:auto;color:grey">
      <p>&copy;Social 2016</p>
    </div>
</div>

<?php
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["user_id"]))
	die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Tidak ada <b style='color:orange'>id user !</b></p>");

$id = $_GET["user_id"];
$query = $conn -> prepare("select * from user where user_id=?");
$query->bind_param("i",$id);
$result = $query->execute();


if(!$result)
	die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Gagal <b style='color:orange'>query !</b></p>");
$rows = $query->get_result();
$row = $rows->fetch_array();
if($rows->num_rows==0)
	die("<p style='font-size:50px;text-align:center;margin-top:250px;'>User tidak <b style='color:orange'>tidak ditemukan !</b></p>");
if(! isset($_POST["oldpass"]) ||
   ! isset($_POST["newpass"]) ||
   ! isset($_POST["confirm"]))
	die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Data Password <b style='color:orange'>tidak lengkap !</b></p>");

if(md5($_POST["oldpass"]) == $row['password']){
 if($_POST["newpass"] == $_POST["confirm"])
    {
        $password  = md5($_POST["newpass"]);    
    }
    else{
        die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Password tidak cocok dengan <b style='color:orange'>confirm !</b></p>");
    }
}



$query = $conn->prepare("update user set password=?  where user_id=?");
$query->bind_param("ss",$password,$id);
$result = $query->execute();

if($result)
	echo"<p style='font-size:50px;text-align:center;margin-top:250px;'>Data user berhasil <b style='color:orange'>di update</b></p>";
else
  header("refresh:3;url=edit.php?user_id=".$row['user_id']);
	die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Gagal mengupdate <b style='color:orange'>data user</b></p>");
  
?>
<div style="width:300px;margin:auto;margin-top:-40px">
        <br>
        <a href ="content.php?user_id=<?php echo $row['user_id'] ?>" style="padding-left:135px;padding-right:135px">Back</a>
    </div>
</body>
</html>