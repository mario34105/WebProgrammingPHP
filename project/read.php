<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
</head>
<body>
<?php
require_once"db.php";
$conn = konek_db();

$query = $conn->prepare("select * from produk");
$result =  $query->execute();

if(! $result)
	die("gagal query");

$rows = $query -> get_result();
?>
	<table>
		<tr>
			<th>ID</th>
			<th>Nama Produk</th>
			<th>harga Satuan</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
<?php
while ($row = $rows->fetch_array()) {
	$url_edit = "edit.php?id=" .$row['id'];
	$url_delete = "delete.php?id=" .$row['id'];
	if($row["image"] == null || $row["image"]=="")
		$url_image = "images/noimage.png";
	else
		$url_image = "images/" . $row["image"];
	echo"<tr>";
	echo"<td>" . $row['id']."</td>";
	echo"<td>" . $row['nama']."</td>";
	echo"<td>" . $row['harga']."</td>";
	echo"<td> <img src=\"$url_image\" style=\"width:320px;\"> </td>";
	echo"<td> <a href='" . $url_edit . "'><button>Edit</button></a>\n";
	echo"<a href='" . $url_delete . "'><button>Hapus</button></a> </td>";
	echo"</tr>\n";
}
?>
</body>
</html>