<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
    .wrapper{
        width:50%;
        padding:0px;
        }
        html{
            overflow:hidden;
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
            padding-top:5px;padding-bottom:5px;padding-left:123px;padding-right:122px;
            border:none;
            text-decoration:none;
        }
        .footer{
        position:fixed;
        background:black;
        text-align:center;
        width:100%;
        margin-top:-930px;
        left:0px;
        right:0px;
        }

    </style>
</head>
<body>
<?php
require_once "db.php";

if (isset($_POST["name"]) && isset($_POST["birth"]) && isset($_POST["gender"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {

    $name  = $_POST["name"];
    $birth = $_POST["birth"];
    $gender  = $_POST["gender"];
    $username  = $_POST["username"];

    if($gender == "Male"){
        $gender = "Male";
    }
    else if ($gender == "Female"){
        $gender = "Female";
    }

    if($_POST["password"] == $_POST["confirm"])
    {
        $password  = md5($_POST["password"]);    
    }
    else{
        die("<p>password tidak cocok dengan confirm</p>");
    }
    $conn = konek_db();

    // bangun query yang akan dieksekusi menggunakan prepared statement
    // simbol ? pada statement query akan diisikan dengan parameter query
    // sesuai dengan parameter pada pemanggilan method bind_param
    $query = $conn->prepare("insert into user(username,password,name,birth,gender) values(?,?,?,?,?)");
    // pasangkan parameter query dengan method bind_param
    // parameter pertama adalah string yang berisikan format data 
    // masing-masing parameter query
    // s -- string
    // i -- integer
    // d -- double
    // b -- blob/binary
    // parameter ke-dua dan seterusnya adalah parameter query
    // yang akan dipasangkan pada statement query
    $query->bind_param("sssss",$username,$password,$name,$birth,$gender);

    // jalankan query
    $result = $query->execute();



    if (! $result){
        echo"<div style='width:300px;margin:auto;margin-top:325px;'>";
        echo"<br>";
        echo"<a href ='login_form.php#register' style='bottom:-100px;padding-left:135px;padding-right:135px;'>Back</a></div>";
        die("<p style='font-size:50px;text-align:center;margin-top:-125px;'>Proses query <b style='color:orange'>gagal !</b></p>");
    }

    echo "<p style='font-size:50px;text-align:center;margin-top:250px;'>Data user berhasil <b style='color:orange'>ditambahkan !</b></p>";
} else {
    echo "<p style='font-size:50px;text-align:center;margin-top:250px;'>Data user belum <b style='color:orange'>diisi !</b></p>";
}
?>
    <div style="width:300px;margin:auto;margin-top:-40px">
        <br>
        <a href ="login_form.php#register" style="padding-left:135px;padding-right:135px">Back</a>
    </div>
</body>
</html>
