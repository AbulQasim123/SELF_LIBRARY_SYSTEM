<?php 
	include 'header.php';
	if (isset($_POST['update'])) {
		$error = '';
		if (empty($_POST['stu_name']) || empty($_POST['stu_address']) || empty($_POST['stu_gender']) || empty($_POST['stu_class']) || empty($_POST['stu_age']) || empty($_POST['stu_phone']) || empty($_POST['stu_email'])) {
			$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>All Field are required ?</div>';
		}else{
			// validate input
			$student_id = mysqli_real_escape_string($con,$_POST['stu_id']);
			$student_name = mysqli_real_escape_string($con,$_POST['stu_name']);
			$student_address = mysqli_real_escape_string($con,$_POST['stu_address']);
			$student_gender = mysqli_real_escape_string($con,$_POST['stu_gender']);
			$student_class = mysqli_real_escape_string($con,$_POST['stu_class']);
			$student_age = mysqli_real_escape_string($con,$_POST['stu_age']);
			$student_phone = mysqli_real_escape_string($con,$_POST['stu_phone']);
			$student_email = mysqli_real_escape_string($con,$_POST['stu_email']);

			// Update student
			$update_sql = "UPDATE `student` set `student_name` = '{$student_name}', `student_address` ='{$student_address}', `student_gender` = '{$student_gender}', `student_class` = '{$student_class}',`student_age` = '{$student_age}', `student_phone` = '{$student_phone}', `student_email` = '{$student_email}' where `student_id` = '{$student_id}' ";
			if (mysqli_query($con,$update_sql)) {
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
	<title>Update Student</title>
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
				<div class="col-lg-3">
					<h2 class="admin-heading">Update Student</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<?php 
								$stu_id = $_GET['sid'];
								$sql = "SELECT * from `student` where `student_id`='{$stu_id}' ";
								$result = mysqli_query($con,$sql);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
							?>
							<form action="" method="post" autocomplete="off">
								<div class="form-group">
									<input type="hidden" name="stu_id" id="stu_id" value="<?php echo $row['student_id']; ?>">
								</div>
								<div class="form-group">
									<label for="stu_name">Student Name</label>
									<input type="text" name="stu_name" id="stu_name" class="form-control" value="<?php echo $row['student_name']; ?>">
								</div>
								<div class="form-group">	
									<label for="stu_address">Student Addres</label>
									<input type="text" name="stu_address" id="stu_address" class="form-control" value="<?php echo $row['student_address']; ?>">
								</div>
								<div class="form-group">
									<label for="stu_gender">Student Gender</label>
									<select name="stu_gender" id="stu_gender" class="form-control">
										<option value="">Select Gender</option>
										<option value="Male" <?php echo ($row['student_gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
										<option value="Female" <?php echo ($row['student_gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
									</select>
								</div>
								<div class="form-group">
									<label for="stu_class">Student Class</label>
									<input type="text" name="stu_class" id="stu_class" class="form-control" value="<?php echo $row['student_class']; ?>">
								</div>
								<div class="form-group">
									<label for="stu_age">Student Age</label>
									<input type="text" name="stu_age" id="stu_age" class="form-control" value="<?php echo $row['student_age']; ?>">
								</div>
								<div class="form-group">
									<label for="stu_phone">Student Phone</label>
									<input type="text" name="stu_phone" id="stu_phone" class="form-control" value="<?php echo $row['student_phone']; ?>">
								</div>
								<div class="form-group">
									<label for="stu_email">Student Email</label>
									<input type="text" name="stu_email" id="stu_email" class="form-control" value="<?php echo $row['student_email']; ?>">
								</div>
								<input type="submit" value="Update" id="update" name="update" class="btn btn-primary btn-sm" value="Update">
								<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/student.php" class="btn btn-secondary btn-sm">Back</a>
							</form>
							<?php 	} } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>