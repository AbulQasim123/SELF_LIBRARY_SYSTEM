<?php 
	include_once 'header.php';
	include_once 'db_connect.php';
	$error = '';
	$success = '';
	if (isset($_POST['save'])) { // if form submit
		$old_pass = mysqli_real_escape_string($con, $_POST['old_pass']);
		$new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
		$conf_pass = mysqli_real_escape_string($con, $_POST['conf_pass']);
		if (isset($old_pass) && isset($new_pass) && isset($conf_pass)) {
			if (empty($old_pass)) {
				$error = '<div style="font-size:18px; font-style:italic;" class="alert alert-danger my-2">Old password is required ?</div>';
			}else if (empty($new_pass)) {
				$error = '<div style="font-size:18px; font-style:italic;" class="alert alert-danger my-2">New password is required ?</div>';
			}else if ($new_pass !== $conf_pass) {
				$error = '<div style="font-size:18px; font-style:italic;" class="alert alert-danger my-2">The Confirmation password does not match !</div>';
			}else{
				$old_pass = md5($old_pass);
				$new_pass = md5($new_pass);
				$user_id = $_SESSION['user_id'];

				$sql_1 = "SELECT `password` from `admin` where `user_id` ='{$user_id}' AND `password`= '{$old_pass}'";
				$result = mysqli_query($con,$sql_1);
				if (mysqli_num_rows($result) == 1) {
					$sql_2 = "UPDATE `admin` set `password` = '{$new_pass}' where `user_id` = '{$user_id}' ";
					mysqli_query($con,$sql_2);
					$success = '<div class="alert alert-success my-2 alert-dismissible text-success" style="font-size: 18px; font-style:italic;"><button type="button" class="close" data-dismiss="alert">&times;</button>Password Changed successfully.</div>';
					header("Location:$Base_url?redirect");
				}else{
					$error = '<div class="alert alert-danger text-danger my-2 alert-dismissible" style="font-size: 18px; font-style:italic;"><button type="button" class="close" data-dismiss="alert">&times;</button>Your Old password does not match with our record !</div>';
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
      <title></title>
	  <link rel="stylesheet" href="css/Customstyle.css">
</head>
<body>
	<div class="container">
		<?php
			if(isset($error)){
				echo $error;
			}
		?>
	</div>
	<div class="container">
		<div class="card my-3" style="background:#eee;">
			<div class="card-header">
				<h5>Change Password</h5>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card-body">
						<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
							<div class="form-group">
								<input type="hidden" name="username" id="username"/>
							</div>
							<div class="form-group">
								<label for=""><strong>Old Password</strong></label>
								<input type="text" class="form-control" id="old_pass" name="old_pass" placeholder="Enter Old Password">
							</div>
							<div class="form-group">
								<label for="New Password"><strong>New Password</strong></label>
								<input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Enter New Password">
							</div>
							<div class="form-group">
								<label for="New Password"><strong>Confirm new Password</strong></label>
								<input type="password" class="form-control" id="conf_pass" name="conf_pass" placeholder="Enter Confirm new Password">
							</div>
							<div class="form-group">
								<input type="submit" name="save" id="save" class="btn btn-danger" value="Save">
							</div>
						</form>
						<?php
							
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once 'footer.php'; ?>
</body>
</html>