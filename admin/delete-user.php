<?php include "header.php"; 
include "config.php";
if($_SESSION["user_role"]=='0'){
	header("location:http://localhost:8012/news/admin/post.php");
}

$userid=$_GET['id'];
$sql="DELETE from user where user_id='{$userid}'";

if(mysqli_query($conn,$sql)){
	header("location:http://localhost:8012/news/admin/users.php");
}else{
	echo "<p style='color:red;margin:10px 0;'> can't delete the user.</p>";
}
mysqli_close($conn); 
?>