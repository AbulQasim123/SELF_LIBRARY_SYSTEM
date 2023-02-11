<?php 
    include_once 'header.php';
	if (isset($_POST['submit'])) {
		$error = '';
		$category_name = mysqli_real_escape_string($con,$_POST['category_name']);
		if (isset($category_name)) {
			if (empty($category_name)) {
				$error .= '<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>Category Name is required ?</div>';
			}else{
				// Check Category name exits or not 
				$check_sql = "SELECT * from `category` where `category_name` = '{$category_name}' ";
				$result = mysqli_query($con,$check_sql);
				if (mysqli_num_rows($result) > 0) {
					$error .= '<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>Category Name is Already exist !</div>';
				}else{
					$insert_sql = "INSERT into `category`(`category_name`) values ('{$category_name}') ";
					if (mysqli_query($con,$insert_sql)) {
						header("Location:$Base_url/category.php");
					}
				}
			}
		}
	}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add Category</title>
</head>
<body>
    <div  id="admin-content" class="">
		<div class="container">
			<?php
				if (isset($error)) {
					echo $error;
				}
			?>
			<div class="row">
				<div class="col-md-6">
					<h2 class="admin-heading" style="width: 46%;">Add Category</h2>
				</div>
				<div class="col-md-6">
					<a href="category.php" class="add-new btn btn-primary btn-sm float-right">All Category</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
								<div class="form-group">
									<label for="category_name">Category Name</label>
									<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name">
								</div>
								<input type="submit" class="btn btn-primary btn-sm" value="Add" name="submit" id="submit">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>
</body>
</html>