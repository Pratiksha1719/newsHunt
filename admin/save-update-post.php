<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
	$file_name=$_POST['old-image'];
}
else{
	$errors=array();
	
	$file_name=$_FILES['new-image']['name'];
	$file_size=$_FILES['new-image']['size'];
	$file_tmp=$_FILES['new-image']['tmp_name'];
	$file_type=$_FILES['new-image']['type'];
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
$sql="update post set title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category='{$_POST["category"]}',post_img='{$file_name}'
	where post_id={$_POST["post_id"]}";
		if(mysqli_query($conn,$sql)){
			header("location:http://localhost:8012/news/admin/post.php");
		}
?>