<!DOCTYPE html>
<html>
<head>
    <title>Find Friends</title>
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
            padding-left:10px;padding-right:10px;
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
        table{
          margin-left:30px;
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
require_once"db.php";
$conn = konek_db();

$query = $conn->prepare("select * from profile");
$result =  $query->execute();

if(! $result)
  die("gagal query");

$rows = $query -> get_result();
?>
<div class="wrapper">

    <div style="width:60%;margin:auto">
      <p style="font-size:50px;margin-top:140px;text-align:center"><b style="color:orange;">Find </b>Friends !
      <hr style="border-color:orange;margin-top:-40px">
      </p>
    </div>

<table>

<?php
while ($row = $rows->fetch_array()) {

  if($row["image"] == null || $row["image"]=="")
    $url_image = "images/no.png";
  else
    $url_image = "images/".$row['first_name']."/". $row["image"];

  echo"<tr>";
  echo"<td style='width:200px'><img src=\"$url_image\"></td>";
  echo"<td style='font-size:30px;width:300px'>" . $row['first_name']." ".$row['last_name']."</td>";
 
  echo"<td> <a href='content.php?user_id=" .$row['user_id'] . "'> Go </a>\n";
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