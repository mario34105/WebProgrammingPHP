<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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

if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["gender"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {

    $firstname  = $_POST["first_name"];
    $lastname  = $_POST["last_name"];
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
        echo"<div style='width:300px;margin:auto;margin-top:325px;'>";
        echo"<br>";
        echo"<a href ='login_form.php#register' style='bottom:-100px;padding-left:135px;padding-right:135px;'>Back</a></div>";
        die("<p style='font-size:50px;text-align:center;margin-top:-120px'>password tidak cocok dengan <b style='color:orange'>confirm</b></p>");
    }
    $conn = konek_db();

    // bangun query yang akan dieksekusi menggunakan prepared statement
    // simbol ? pada statement query akan diisikan dengan parameter query
    // sesuai dengan parameter pada pemanggilan method bind_param
    $query = $conn->prepare("insert into user(username,password,first_name,last_name,gender) values(?,?,?,?,?)");
    // pasangkan parameter query dengan method bind_param
    // parameter pertama adalah string yang berisikan format data 
    // masing-masing parameter query
    // s -- string
    // i -- integer
    // d -- double
    // b -- blob/binary
    // parameter ke-dua dan seterusnya adalah parameter query
    // yang akan dipasangkan pada statement query
    $query->bind_param("sssss",$username,$password,$firstname,$lastname,$gender);

    // jalankan query
    $result = $query->execute();

    $query1 = $conn->prepare("select user_id from user where username=?");
    $query1 -> bind_param("s",$username);
    $result1 = $query1->execute();
    $result2 = $query1->get_result();
    $data = $result2 ->fetch_array(); 

    $query2 = $conn->prepare("insert into profile(user_id) values(?)");
    $query2->bind_param("i",$data["user_id"]);
    $result3 = $query2->execute();

    $query3= $conn->prepare("insert into talent(user_id) values(?)");
    $query3->bind_param("i",$data["user_id"]);
    $result4 = $query3->execute();

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
