<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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
error_reporting(0);
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["user_id"]))
    die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Tidak ada <b style='color:orange'>id user !</b></p>");

$id = $_GET["user_id"];
$query = $conn -> prepare("select * from profile,talent where profile.user_id = talent.user_id && profile.user_id=?");
$query->bind_param("i",$id);
$result = $query->execute();



if(!$result)
    die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Gagal <b style='color:orange'>query !</b></p>");
$rows = $query->get_result();
$row = $rows->fetch_object();

if($rows->num_rows==0)
    die("<p style='font-size:50px;text-align:center;margin-top:250px;'>User <b style='color:orange'>tidak ditemukan !</b></p>");


$first = $_POST["first_name"];
$last = $_POST["last_name"];
$birth = $_POST["birth"];
$message = $_POST["message"];
$address = $_POST["address"];
$hobby = $_POST["hobby"];
$education = $_POST["education"];
$email = $_POST["email"];
$telp = $_POST["telp"];
$talent = $_POST["talent"];
$profile_id = '';


if($first==null){
  $first = $row->first_name;
}
if($last==null){
  $last = $row->last_name;
}
if($birth==null){
  $birth = $row->birth;
}
if($message==null){
  $message = $row->message;
}
if($address==null){
  $address = $row->address;
}
if($hobby==null){
  $hobby = $row->hobby;
}
if($education==null){
  $education = $row->education;
}
if($email==null){
  $email = $row->email;
}
if($telp==null){
  $telp = $row->telp;
}
if($profile_id==''){
  $profile_id = $row->profile_id;
}
if($talent==null){
  $talent = $row->talent_name;
  if($row->talent_name == null)
    $talent = "no";
}


$file_gambar = "";

if(isset($_FILES["image"])) {

  if($_FILES["image"]["error"] == 0 ){

    if($row->image == null){
      $file_gambar = "images/no.png";
    }

    $image = $row->image;

    if($image !=null && file_exists("images/$profile_id - $first/$image")){
      unlink("images/$profile_id - $first/$image");
    }

  //salin gambar yang diupload ke folder images

    if(isset($_FILES["image"])) { //1
      if($_FILES["image"]["error"] == 0) {//2
        $image = $_FILES["image"];

        $extension = new SplFileInfo($image["name"]);
        $extension = $extension -> getExtension();
        $file_gambar = $first . "." .$extension;
        mkdir("images/$profile_id - $first");
        copy($image["tmp_name"] , "images/$profile_id - $first/". $file_gambar);
          }//2
      }//1
  }
    else {
      $file_gambar = $row->image;
    }
}

$query = $conn->prepare("update profile set first_name=?,last_name=?,birth=?,message=?,address=?,hobby=?,education=?,email=?,telp=?,image=? where profile_id=?");
$query->bind_param("ssssssssssi",$first,$last,$birth,$message,$address,$hobby,$education,$email,$telp,$file_gambar,$profile_id);
$result = $query->execute();


$query1 = $conn->prepare("update talent set talent_name=? where user_id=?");
$query1->bind_param("si",$talent,$id);
$result1 = $query1->execute();

if($result){
  echo"<p style='font-size:50px;text-align:center;margin-top:250px;'>Profile User berhasil <b style='color:orange'>di update</b></p>";
} 
else{
 header("refresh:200;url=profile.php?user_id=".$row['user_id']);
    die("<p style='font-size:50px;text-align:center;margin-top:250px;'>Gagal mengupdate <b style='color:orange'>data user</b></p>");
}
  
?>
<div style="width:400px;margin:auto;margin-top:-40px">
        <br>
        <a href ="content.php?user_id=<?php echo $row->user_id ?>" style="padding-left:135px;padding-right:135px">Go to Profile</a>
    </div>
</body>
</html>