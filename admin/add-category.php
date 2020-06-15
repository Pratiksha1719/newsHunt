<?php include "header.php"; 
include "config.php";
if(isset($_POST['save'])){
	$cat=$_POST['cat'];
	
	$sql="SELECT category_name from category WHERE category_name='{$cat}'";
	$result=mysqli_query($conn,$sql)or die("query failed");
	
	
	
	
	 $sql1="insert into category (category_name) values ('{$cat}')";
	if(mysqli_query($conn,$sql1)){
			header("location:http://localhost:8012/news/admin/category.php");
		}
	}






?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER ['PHP_SELF'];?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
