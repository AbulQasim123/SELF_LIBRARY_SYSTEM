<?php 
	include 'header.php';
	if (isset($_POST['submit'])) {
		$error = '';
		$publisher_name = mysqli_real_escape_string($con,$_POST['publisher_name']);
		if (isset($publisher_name)) {
			if (empty($publisher_name)) {
				$error .= '<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>Publisher Name is required ?</div>';
			}else{
				// Check Publisher name exits or not 
				$check_sql = "SELECT * from `publisher` where `publisher_name` ='{$publisher_name}' ";
				$result = mysqli_query($con,$check_sql);
				if (mysqli_num_rows($result) > 0) {
					$error .= '<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>Publisher Name is Already exist !</div>';
				}else{
					$insert_sql = "INSERT into `publisher`(`publisher_name`) values('{$publisher_name}') ";
					if (mysqli_query($con,$insert_sql)) {
						header("Location:$Base_url/publisher.php");
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
	<title>Add Publisher</title>
</head>
<body>
    <div class="" id="admin-content">
		<div class="container">
			<?php 
				if (isset($error)) {
					echo $error;
				}
			?>
			<div class="row">
				<div class="col-md-6">
					<h2 class="admin-heading" style="width: 46%;">Add Publisher</h2>
				</div>
				<div class="col-md-6">
					<a href="publisher.php" class="add-new btn btn-primary btn-sm float-right">All Publisher</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
								<div class="form-group">
									<label for="publisher_name">Publisher Name</label>
									<input type="text" class="form-control" id="publisher_name" name="publisher_name" placeholder="Enter Publisher Name">
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