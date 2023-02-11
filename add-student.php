<?php
	include 'header.php';
	if(isset($_POST['add'])){
		$error = '';
		if (empty($_POST['std_name']) || empty($_POST['std_address']) || empty($_POST['std_gender']) || empty($_POST['std_age']) || empty($_POST['std_class']) || empty($_POST['std_phone']) || empty($_POST['std_email'])) 
		{
			$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>All Field are required ?</div>';
		}else{
			// validate input
			$std_name = mysqli_real_escape_string($con,$_POST['std_name']);
			$std_address = mysqli_real_escape_string($con,$_POST['std_address']);
			$std_gender = mysqli_real_escape_string($con,$_POST['std_gender']);
			$std_class = mysqli_real_escape_string($con,$_POST['std_class']);
			$std_age = mysqli_real_escape_string($con,$_POST['std_age']);
			$std_phone = mysqli_real_escape_string($con,$_POST['std_phone']);
			$std_email = mysqli_real_escape_string($con,$_POST['std_email']);
			// insert into student
			$insert_sql = "INSERT into `student`(`student_name`,`student_address`,`student_gender`,`student_class`,`student_age`,`student_phone`,`student_email`) values ('{$std_name}','{$std_address}','{$std_gender}','{$std_class}','{$std_age}','{$std_phone}','{$std_email}') ";
			if (mysqli_query($con,$insert_sql)) {
				header("Location:$Base_url/student.php");
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
	<title>Add Student</title>
	<link rel="stylesheet" href="css/Customstyle.css">
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
				<div class="col-md-6">
					<h2 class="admin-heading" style="width: 46%;">Add Student</h2>
				</div>
				<div class="col-md-6">
					<a href="student.php" class="add-new btn btn-primary btn-sm float-right">All Student</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card" style="background-color: lightgray">
						<div class="card-body">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
								<div class="form-group">
									<label for="std_name">Student Name</label>
									<input type="text" name="std_name" id="std_name" class="form-control" placeholder="Enter Student Name">
								</div>
								<div class="form-group">
									<label for="std_address">Address</label>
									<input type="text" name="std_address" id="std_address" class="form-control" placeholder="Enter Student Address">
								</div>
								<div class="form-group">
									<label for="std_gender">Gender</label>
									<select name="std_gender" id="std_gender" class="form-control">
										<option value="">Select Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
								<div class="form-group">
									<label for="std_class">Class</label>
									<input type="text" name="std_class" id="std_class" class="form-control" placeholder="Enter Class">
								</div>
								<div class="form-group">
									<label for="std_age">Age</label>
									<input type="text" name="std_age" id="std_age" class="form-control" placeholder="Enter Age">
								</div>
								<div class="form-group">
									<label for="std_phone">Phone</label>
									<input type="text" name="std_phone" id="std_phone" class="form-control" placeholder="Enter Phone">
								</div>
								<div class="form-group">
									<label for="std_email">Email</label>
									<input type="text" name="std_email" id="std_email" class="form-control" placeholder="Enter Email">
								</div>
								<input type="submit" value="Add" id="add" name="add" class="btn btn-primary btn-sm">
								<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/student.php" class="btn btn-secondary btn-sm">Back</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>