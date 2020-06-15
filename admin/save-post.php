<?php
include"config.php";
if(isset($_FILES['fileToUpload'])){
	$errors=array();
	
	$file_name=$_FILES['fileToUpload']['name'];
	$file_size=$_FILES['fileToUpload']['size'];
	$file_tmp=$_FILES['fileToUpload']['tmp_name'];
	$file_type=$_FILES['fileToUpload']['type'];
	$file_ext=strtolower(end(explode('.',$file_name)));
	$extentions=array("jpeg","jpg","png");
	
	if(in_array($file_ext,$extentions)===false){
 	$errors[]="this type of extention is not allowed please upload jpeg,jpg,png files";
	}
	if($file_size>2097152)
	{
		$errors[]="file size must be 2Mb or lower";
	}   
	if(empty($errors)==true){
		move_uploaded_file($file_tmp,"upload/".$file_name);
	}else{
		print_r($errors);
		die();
	}
}

session_start();
$title=mysqli_real_escape_string($conn,$_POST['post_title']);
$description=mysqli_real_escape_string($conn,$_POST['postdesc']);
$category=mysqli_real_escape_string($conn,$_POST['category']);
$date=date("d M,Y");

$author= $_SESSION['user_id'];

$sql="insert into post(title,description,category,post_date,author,post_img)
values('{$title}','{$description}','{$category}','{$date}',{$author},'{$file_name}');";
$sql.="update category set post = post+1 where category_id = {$category}";
//echo $sql;
//die();
if(mysqli_multi_query($conn,$sql))
{
	header("location:http://localhost:8012/news/admin/post.php");

}	else{
	echo "<div class='alert alert-danger'>query failed</div>";
}
?> 