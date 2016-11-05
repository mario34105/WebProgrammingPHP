<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Find Friends</title>
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
        .option{
      float:right;
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
        table{
          padding-bottom:100px;
        }
        tr,td{
          padding-top:50px;
          padding-bottom:50px;
        }

        img{
          max-height: 100px;
          max-width: 100px;
          height:auto;
          width:auto;
       }
  </style>
</head>
<body>
<?php

$id = $_GET["user_id"];
require_once"db.php";
$conn = konek_db();

$query = $conn->prepare("select * from profile where user_id=?");
$query->bind_param("i",$id);
$result =  $query->execute();

if(! $result)
  die("gagal query");

$rows = $query -> get_result();
$row = $rows->fetch_array();


?>
<div class="wrapper">
    <div class="header">
    <p style="width:30%">Welcome, <a href="content.php?user_id=<?php echo $row['user_id'];?>" style="background:none;padding:0"><b style="color:orange"><?php echo $_SESSION["username"] ?></b></a> </p>
    <div class="option" style="margin-top:-35px">   
      <a href="edit.php?user_id=<?php echo $row['user_id']; ?>">Change Password</a>
      <a href="profile.php?user_id=<?php echo $row['user_id'];?>">Edit Profile</a>
      <a href="logout.php">Logout</a>
      <a href="delete.php?user_id=<?php echo $data['user_id'];?>">Delete Acc</a>
    </div>
  </div>
    <div style="width:60%;margin:auto">
      <p style="font-size:50px;margin-top:140px;text-align:center"><b style="color:orange;">Find </b>Friends !
      <hr style="border-color:orange;margin-top:-40px">
      </p>
    </div>

<table>

<?php

$query1 = $conn->prepare("select * from profile,talent where profile.user_id=talent.user_id && profile.user_id != $id");
$result1 = $query1->execute();



if(! $result1)
  die("gagal query");

$rows1 = $query1 -> get_result();

while ($row1 = $rows1->fetch_array()) {

  if($row1["image"] == null || $row1["image"] == "")
    $url_image = "images/no.png";
  else
    $url_image = "images/".$row1['profile_id']." - ".$row1['first_name']."/". $row1["image"];

  if($row1["talent_name"] == null || $row1["talent_name"] == "")
    $url_image1 = "images/talent/no.png";
  else
    $url_image1 = "images/talent/".$row1["talent_name"].".png";

  echo"<tr>";
  echo"<td style='width:200px'><img src=\"$url_image\"></td>";
  echo"<td style='font-size:30px;width:250px'>" . $row1['first_name']." ".$row1['last_name']."</td>";
  echo"<td style='width:150px'><img src=\"$url_image1\"></td>";
  echo"<td> <a href='content.php?user_id=" .$row1['user_id'] . "' style='margin-left:-10px'> Go </a>\n";
  echo"</tr>\n";
}
?>
</table>
<div class="footer">
    <div class="footercontent" style="margin:auto;color:grey">
      <p>&copy;Social 2016</p>
    </div>
</div>
</div>
</body>
</html>