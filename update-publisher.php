<?php 
	include_once 'header.php';
	if (isset($_POST['update'])) {
			// validate input 
		$error = '';
		$publisher_id = mysqli_real_escape_string($con,$_POST['publisher_id']);
		$publisher_name = mysqli_real_escape_string($con,$_POST['publisher_name']);

		if (isset($publisher_id) && isset($publisher_name)) {
			if (empty($publisher_name)) {
				$error = '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Publisher Name is required ?</div>';
			}else{
				// Update query 
				$update_sql = "UPDATE `publisher` set `publisher_name` = '{$publisher_name}' where `publisher_id`= '{$publisher_id}' ";
				if (mysqli_query($con,$update_sql)) {
					header("Location:$Base_url/publisher.php");
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
	<title>Update Publisher</title>
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
					<h2 class="admin-heading">Update Publisher</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background: lightgray;">
						<div class="card-body">
							<?php 
								$publisher_id = $_GET['pid'];
								$sql = "SELECT * from `publisher` where `publisher_id` = '{$publisher_id}' ";
								$result = mysqli_query($con,$sql) or die("SQL Query Failed");
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
							?>
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
								<div class="form-group">
									<input type="hidden" name="publisher_id" name="publisher_id" value="<?php echo $row['publisher_id']; ?>">
								</div>
								<div class="form-group">
									<label for="publisher_name">Publisher Name</label>
									<input type="text" name="publisher_name" id="publisher_name" class="form-control" placeholder="Enter Publisher Name" value="<?php echo $row['publisher_name']; ?>">
								</div>
								<input type="submit" value="Update" id="update" name="update" class="btn btn-primary btn-sm">
								<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/publisher.php" class="btn btn-secondary btn-sm" id="back" name="back">Back</a>
							</form>
							<?php 	}}  ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<?php include_once 'footer.php'; ?>
</body>
</html>