<?php
	include_once 'header.php';
	if(isset($_POST['update'])){  // if form submit
		// Validate input
		$error = '';
		$author_id = mysqli_real_escape_string($con,$_POST['author_id']);
		$author_name = mysqli_real_escape_string($con,$_POST['author_name']);
		if(isset($author_id) && isset($author_name) ){
			if (empty($author_name)) {
				$error = '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Author Name is required ?</div>';
			}else{
				// update query
				$update_sql = "UPDATE `author` set `author_name` = '{$author_name}' where `author_id` = '{$author_id}' ";
				if (mysqli_query($con,$update_sql)) {
					header("Location:$Base_url/author.php");
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
	<title>Update author</title>
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" href="css/jquery.dataTables.css"> -->

	<!-- <link rel="stylesheet" href="css/Customstyle.css"> -->

	<!-- <script type="text/javascript" src="js/popper.min.js"></script>

	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script> -->

	<!-- <script type="text/javascript" src="js/jquery.dataTables.min.js" defer></script> -->
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
					<h2 class="admin-heading">Update Author</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background: lightgray">
						<div class="card-body">
							<?php
								$author_id = $_GET['aid'];
								$sql = "SELECT * from `author` where `author_id` = '{$author_id}' ";
								$result = mysqli_query($con,$sql) or die("SQL Query Failed");
								if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_assoc($result)){
							?>
							<form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off">
								<div class="form-group">
									<input type="hidden" id="author_id" name="author_id" value="<?php echo $row['author_id']; ?>">
								</div>
								<div class="form-group">
									<label for="author_name"><strong>Author Name</strong></label>
									<input type="text" class="form-control" id="author_name" name="author_name" placeholder="Author Name" value="<?php echo $row['author_name']; ?>">
								</div>
								<input type="submit" name="update" id="update" class="btn btn-primary btn-sm" value="Update">
								<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/author.php" class="btn btn-secondary btn-sm" id="back_btn" name="back_btn">Back</a>
							</form>
							<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once 'footer.php'; ?>
</body>
</html>