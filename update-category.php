<?php
    include_once 'header.php';
	if (isset($_POST['update'])) {
		$error = '';
		$category_id = mysqli_real_escape_string($con,$_POST['category_id']);
		$category_name = mysqli_real_escape_string($con,$_POST['category_name']);
		if (isset($category_id) && isset($category_name)) {
			if (empty($category_name)) {
				$error = '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Category Name is required ?</div>';
			}else{
				// update query
				$update_sql = "UPDATE `category` set `category_name` = '{$category_name}' where `category_id`    ='{$category_id}' ";
				if (mysqli_query($con,$update_sql)) {
					header("Location:$Base_url/category.php");
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
	<title>Update Category</title>
</head>
<body>
	<div id="admin-content">
		<div class="container">
			<?php 
				if (isset($error)) {
					echo $error;
				}
			?>
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading">Update Category</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background: lightgray;">
						<div class="card-body">
							<?php 
								$category_id = $_GET['cid'];
								$sql = "SELECT * from `category` where `category_id` = '{$category_id}' ";
								$result = mysqli_query($con,$sql);
								if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_assoc($result)){
							?>
							<form action="" method="post" autocomplete="off">
								<div class="form-group">
									<input type="hidden" name="category_id" id="category_id" value="<?php echo $row['category_id']; ?>">
								</div>
								<div class="form-group">
									<label for="category_name">Category Name</label>
									<input type="text" id="category_name" name="category_name" value="<?php echo $row['category_name']; ?>" placeholder="Enter Category Name" class="form-control">
								</div>
								<input type="submit" value="Update" id="update" name="update" class="btn btn-primary btn-sm">
								<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/category.php" class="btn btn-primary btn-sm">Back</a>
							</form>
							<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>
</body>
</html>