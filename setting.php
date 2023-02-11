<?php 
	include 'header.php';
	$error = '' ;
	$success = '';
	if (isset($_POST['update'])) {
		if (empty($_POST['return_days']) || empty($_POST['charges'])) {
			$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Please fill all the feild ?</div>';
		}else{
			// validate input
			$setting_id = mysqli_real_escape_string($con,$_POST['setting_id']);
			$return_days = mysqli_real_escape_string($con,$_POST['return_days']);
			$charges = mysqli_real_escape_string($con,$_POST['charges']);
			// update sql 
			$update_sql = "UPDATE `setting` set `return_days` = '$return_days', `fine` = '{$charges}' where `id` = '{$setting_id}' ";
			$result = mysqli_query($con,$update_sql);
			if ($result) {
				$success .= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Updated successfully.</div>';
			}else{
				$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Updated not successfully!</div>';
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
	<title>Settings</title>
</head>
<body>
    <div id="admin-content">
		<div class="container">
			<?php
				if(isset($error)){
					echo $error;
				}
				if(isset($success)){
					echo $success;
				}
			?>
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading" style="width: 60%;">Settings</h2>
				</div>
			</div>
			<div class="row">
				<div class="offset-md-3 col-md-6">
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<?php 
								// Select query
								$sql = "SELECT * from `setting` ";
								$result = mysqli_query($con,$sql);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
							?>
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
								<div class="form-group">
									<input type="hidden" name="setting_id" id="setting_id" value="<?php echo $row['id']; ?>" >
								</div>
								<div class="form-group">
									<label for="return_days">Return Days</label>
									<input type="text" name="return_days" id="return_days" class="form-control" value="<?php echo $row['return_days']; ?>">
								</div>
								<div class="form-group">
									<label for="charges">charges (in Rs)</label>
									<input type="text" name="charges" id="charges" class="form-control" value="<?php echo $row['fine']; ?>">
								</div>
								<input type="submit" class="btn btn-primary btn-sm" name="update" value="Save">
							</form>
							<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php include 'footer.php'; ?>